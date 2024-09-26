<?php

 namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\AbonnementPlan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Kkiapay\Kkiapay;

class AbonnementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:abonnement_plans,id',
        ]);

        $plan = AbonnementPlan::find($request->plan_id);
        $user = auth()->user();
        $transaction_id = uniqid();

        // Enregistrer le paiement dans la base de données
        Payment::create([
            'transaction_id' => $transaction_id,
            'user_id' => $user->id,
            'abonnement_plan_id' => $plan->id,
            'amount' => $plan->prix,
            'currency' => 'XOF',
            'status' => 'pending',
        ]);

        $prix_sans_separateurs = filter_var($plan->prix, FILTER_SANITIZE_NUMBER_INT);

        // Initier le paiement avec Kkiapay
        try {
            $kkiapay = new Kkiapay('$public_key', '$private_key', '$secret'); // en sandbox
            $response = $kkiapay->verifyTransaction([
                'amount' => $prix_sans_separateurs,
                'sandbox' => true,
                'referenceNumber' => $transaction_id,
                'notificationURL' => route('user.payment.notify'),
                'returnURL' => route('user.payment.success', ['transaction_id' => $transaction_id]),
                'description' => 'Payment abonnement plan',
            ]);
            
            dd($response);
            if (is_object($response) && isset($response->status) && $response->status == 'success') {
            return redirect($response->url);
        } else {
                return redirect()->route('user.home')->with('error', 'Échec du paiement. Veuillez réessayer.');
            }
        } catch (\Exception $e) {
            return redirect()->route('user.home')->with('error', $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $transaction_id = $request->input('transaction_id');
        $payment = Payment::where('transaction_id', $transaction_id)->first();

        if ($payment && $payment->status == 'pending') {
            $payment->status = 'success';
            $payment->save();

            // Créer l'abonnement
            Subscription::create([
                'user_id' => $payment->user_id,
                'abonnement_plan_id' => $payment->abonnement_plan_id,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonth(),
            ]);

            return redirect()->route('user.home')->with('success', 'Abonnement créé avec succès.');
        }

        return redirect()->route('user.home')->with('error', 'Le paiement a échoué.');
    }

    public function notify(Request $request)
    {
        $transaction_id = $request->input('transaction_id');
        $status = $request->input('status');
        $payment = Payment::where('transaction_id', $transaction_id)->first();
        if ($payment) {
            $payment->status = $status;
            $payment->save();
            if ($status == 'success') {
                // Créer l'abonnement
                Subscription::create([
                    'user_id' => $payment->user_id,
                    'abonnement_plan_id' => $payment->abonnement_plan_id,
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::now()->addMonth(),
                ]);
            }
        }
    }

    public function verifyTransaction($transaction_id)
    {
        $kkiapay = new Kkiapay('$public_key', '$private_key', '$secret'); // Mettre false en production
        return $kkiapay->verifyTransaction($transaction_id);
    }

    public function refundTransaction($transaction_id)
    {
        $kkiapay = new Kkiapay('$public_key', '$private_key', '$secret'); // Mettre false en production
        return $kkiapay->refundTransaction($transaction_id);
    }

}
