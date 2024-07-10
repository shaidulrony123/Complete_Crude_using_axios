<!-- Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryCreateForm">
                    <div class="mb-3">
                        <label for="category_name">Name</label>
                        <input type="text" id="category_name" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="createCategory()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function createCategory() {
        try {
            let category_name = document.getElementById('category_name').value;

            if (category_name.length === 0) {
                errorToast("Name required");
            } else {
                document.getElementById('modal-close').click();
                showLoader();
                let response = await axios.post('/create-category', {
                    name: category_name
                })
                hideLoader();
                if (response.status === 200) {
                    successToast('Request completed');
                document.getElementById("categoryCreateForm").reset();
                // await getList();
                }else{
                    errorToast("Request fail !")
                }
            }
        } catch (error) {
            console.log(error);
            alert('Something went wrong. Please try again later.');
        }
    }

</script>
