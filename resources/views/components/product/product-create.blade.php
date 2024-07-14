{{-- 
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
</script> --}}
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create New</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productCreateForm">
                    <div class="mb-3">
                        <label for="product_name_create">Product Name</label>
                        <input type="text" id="product_name_create" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select id="category_id" class="form-control">
                            <option value="1">Category 1</option>
                            <option value="2">Category 2</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <img style="width: 100px; height: 100px;" id="image" src="{{asset('assets/images/rony.jpg')}}"/>
                        <br/>
                        <label class="form-label">Image</label>
                        <input oninput="image.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="product_img">
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
    try {
        let product_name_create = document.getElementById('product_name_create').value;
        let category_id = document.getElementById('category_id').value;
        let product_img = document.getElementById('product_img').files[0];

        if (product_name_create.length === 0) {
            errorToast("Name required");
        } else if (!product_img) {
            errorToast("Image required");
        } else {
            document.getElementById('modal-close').click();
            showLoader();

            let formData = new FormData();
            formData.append('product_name', product_name_create);
            formData.append('category_id', category_id);
            formData.append('product_image', product_img);
            
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };
            
            let response = await axios.post('/create-product', formData, config);

            hideLoader();
            if (response.status === 201) {
                successToast('Request completed');
                document.getElementById("productCreateForm").reset();
                await getList(); 
            } else {
                errorToast("Request failed!");
            }
        }
    } catch (error) {
        console.error(error);
        alert('Something went wrong. Please try again later.');
    }
}




</script>