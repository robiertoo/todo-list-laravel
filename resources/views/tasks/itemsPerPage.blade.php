<div class="float-end mb-3">
    <div class="input-group">
        <div class="input-prepend">
            <div class="input-group-text">Items por Página</div>
        </div>
        <select name="itemsPerPage" class='form-control'>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
        </select>
    </div>
</div>

<script>
    window.onload = () => {
        let itemsPerPage = document.querySelector('[name=itemsPerPage]');

        const updateItemsPerPage = async (newNumber) => {
            let response = await fetch('{{ route('users.updateItemsPerPage') }}', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'PATCH',                                                              
                body: JSON.stringify( { newNumber } )                                        
            });


            if(response.status != 201) return;
            window.location.reload();
        }

        itemsPerPage.value = {{ auth()->user()->itemsPerPage }}

        itemsPerPage.addEventListener('change', e => {
            updateItemsPerPage(e.target.value);
        });
    }
</script>