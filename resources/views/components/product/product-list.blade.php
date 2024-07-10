

<div class="btn-header d-flex justify-content-between">
    <h2>Product List</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-modal">
        Create New
      </button>
 </div>
  <div class="card-body mt-5">
    <table id="tableData" class="table table-hover">
        <thead class="table-light text-center">
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="tableList"></tbody>
    </table>
</div>

<script>
     getList();
    async function getList() {
        // showLoader();
        let response=await axios.get("/all-product-list");
        // hideLoader();

        let tableList=$("#tableList");
        let tableData=$("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        response.data.forEach(function (item,index) {
            let row=`<tr>
                        <td>${index+1}</td>
                        <td>${item['product_name']}</td>
                        <td><img width="100" src="{{asset('assets/images')}}/${item['product_img']}}"></td>
                        <td>
                            <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                     </tr>`
            tableList.append(row)
        })

        $('.editBtn').on('click', async function () {
               let id= $(this).data('id');
               await fillUpForm(id)
               $("#update-modal").modal('show');
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
        })

        new DataTable('#tableData',{
           order:[[0,'desc']],
           lengthMenu:[5,10,15,20,30]
       });

    }

</script>
