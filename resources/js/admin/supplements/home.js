function confirmDelete(supplementId, supplementName) {
    document.getElementById("supplement_name").textContent = supplementName;
    document.getElementById("delete_form").action =
        "{{ route('admin.supplements.delete', ['id' => ':id']) }}".replace(
            ":id",
            supplementId
        );
    document.getElementById("delete_modal").showModal();
}
