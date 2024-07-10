<!-- Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productCreateForm">
                    <div class="mb-3">
                        <label for="product_name">Product Name</label>
                        <input type="text" id="product_name" class="form-control">
                    </div>
                    <div class="mb-3">
                                <img style="widith: 100px; height: 100px"  id="newImg" src="{{asset('assets/images/rony.jpg')}}"/>
                                <br/>
                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="product_img">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="createProduct()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function createProduct() {
        let product_name = document.getElementById('product_name').value;
        let product_img = document.getElementById('product_img').files[0];
        if (product_name.length === 0) {
            errorToast("Model Test Name Required !")
        }
        else if (!product_img) {
            errorToast("Model Test Image Required !")
        }
        else {
            document.getElementById('modal-close').click();
            let formData=new FormData();
            formData.append('img',product_img)
            formData.append('product_name',product_name)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            showLoader();
            let res = await axios.post("/create-product",formData,config)
            hideLoader();

            if(res.status=== 200){
                successToast('Request completed');
                document.getElementById("productCreateForm").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
