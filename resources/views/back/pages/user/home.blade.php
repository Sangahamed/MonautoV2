@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
  @livewire('admin.model-abonnement')
  <form id="payment-form" action="{{ route('user.valider-abonnement') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="plan_id" id="plan_id">
</form>
@endsection
@push('scripts')

<script>
    document.querySelectorAll('.subscribe-btn').forEach(button => {
        button.addEventListener('click', function() {
            const planId = this.getAttribute('data-id');
            document.getElementById('plan_id').value = planId;
            document.getElementById('payment-form').submit();
        });
    });
</script>y
@endpush