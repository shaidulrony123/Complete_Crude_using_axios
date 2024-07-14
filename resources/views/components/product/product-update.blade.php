<div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="workUpdateForm">
                    <div class="mb-3">
                        <label for="product_name_update">Name</label>
                        <input type="text" id="product_name_update" class="form-control">
                    </div>
                    <div class="mb-3">
                        <img style="width: 100px; height: 100px;" id="oldImg" src="{{asset('images/images.png')}}" />
                        <br />
                        <label class="form-label mt-2">Image</label>
                        <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                            class="form-control" id="orgImgUpdate">
                    </div>
                    <input type="hidden" id="updateID">
                    <input type="hidden" id="filePath">
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="updateProduct()" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>



<script>
   async function fillUpUpdateForm(id) {
    document.getElementById('updateID').value = id;

    showLoader();
    try {
        let res = await axios.post("/product-by-id", { id: id });
        hideLoader();
        
        if (res.status === 200) {
            document.getElementById('product_name_update').value = res.data['product_name'];
            document.getElementById('oldImg').src = res.data['product_image'];
            document.getElementById('filePath').value = res.data['product_image'];
        } else {
            errorToast("Failed to fetch product details");
        }
    } catch (error) {
        hideLoader();
        console.error(error);
        errorToast("An error occurred while fetching product details");
    }
}

async function updateProduct() {
    let product_name_update = document.getElementById('product_name_update').value;
    let updateID = document.getElementById('updateID').value;
    let filePath = document.getElementById('filePath').value;
    let orgImgUpdate = document.getElementById('orgImgUpdate').files[0];

    if (product_name_update.length === 0) {
        errorToast("Name Required!");
    } else if (!orgImgUpdate && !filePath) {
        errorToast("Image Required!");
    } else {
        let formData = new FormData();
        formData.append('product_name', product_name_update);
        formData.append('id', updateID);
        formData.append('file_path', filePath);

        if (orgImgUpdate) {
            formData.append('product_image', orgImgUpdate);
        }

        document.getElementById('update-modal-close').click();

        showLoader();
        try {
            let res = await axios.post('/update-product', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            hideLoader();

            if (res.status === 200 && res.data === 1) {
                document.getElementById("workUpdateForm").reset();
                successToast("Update successful!");
                await getList();
            } else {
                errorToast("Update failed!");
            }
        } catch (error) {
            hideLoader();
            console.error(error);
            errorToast("An error occurred while updating the product");
        }
    }
}


</script>
