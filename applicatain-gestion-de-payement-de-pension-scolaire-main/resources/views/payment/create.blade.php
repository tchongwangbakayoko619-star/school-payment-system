<form method="POST" action="{{ route('cinetpay.payer') }}">
    @csrf
    <input type="text" name="customer_name" placeholder="Nom" required>
    <input type="text" name="customer_surname" placeholder="Prénom" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="number" name="amount" placeholder="Montant" required>
    <input type="text" name="currency" value="XOF" required>
    <button type="submit" name="valider">Payer</button>
</form>
