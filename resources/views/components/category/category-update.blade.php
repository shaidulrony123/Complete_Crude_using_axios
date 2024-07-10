<div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryUpdateForm">
                    <div class="mb-3">
                        <label for="category_name">Name</label>
                        <input type="text" id="category_name_update" class="form-control">
                    </div>
                    <input class="d-none" id="updateID">
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="updateCategory()" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function fillUpForm(id) {
        document.getElementById('updateID').value = id;
        showLoader();
        let response = await axios.post('/category-by-id', {
            id: id
        })
        hideLoader();
        document.getElementById('category_name_update').value = response.data['name'];

    }

    async function updateCategory() {
        let updateID = document.getElementById('updateID').value;
        let category_name = document.getElementById('category_name_update').value;
        if (category_name.length === 0) {
            errorToast("Name required");
        } else {
            document.getElementById('update-modal-close').click();
            showLoader();
            let response = await axios.post('/update-category', {
                id: updateID,
                name: category_name,

            })
            hideLoader();
            if (response.status === 200) {
                successToast('Request completed');
                document.getElementById("categoryUpdateForm").reset();
                await getList();
            } else {
                errorToast("Request fail !")
            }
        }

    }

</script>
