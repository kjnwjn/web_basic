<div class="col-lg-9 col-md-10 col-xs-6 main__content">
    <div class="row p-3">
        <div class="col my-4 p-3 bg-white border shadow-sm lh-sm">
            <div class="table-list-title">
                <h2 class="ps-4 position-relative">List Account</h2>
                <div class="dropdown ">
                    <button class="btn btn-secondary dropdown-toggle list__type-account" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Type of Account
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" onclick="renderPendingData()">Pending</a>
                        <a class="dropdown-item" href="#" onclick="renderActivedData()">Actived</a>
                        <a class="dropdown-item" href="#" onclick="renderDisabledData()">Disabled</a>
                        <a class="dropdown-item" href="#" onclick="renderAllAccountData()">All Account</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive ">
            <table class="table table-bordered table-striped mt-0">
                <thead>
                    <tr>
                        <th>email</th>
                        <th>Phone Number</th>
                        <th>Status</th>
                        <th>Fullname</th>
                        <th>gender</th>
                        <th>Create date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbody__details">

                </tbody>
            </table>
        </div>
        <div class="modal fade" id="modal__details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Account details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div  class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead id="userdetails-thead" class="thead-dark ">
                                <tr>
                                    <th scope="col">email</th>
                                    <th scope="col">phone number</th>
                                    <th scope="col">full name</th>
                                    <th scope="col">gender</th>
                                    <th scope="col">address</th>
                                    <th scope="col">bithday</th>
                                    <th scope="col">id card front</th>
                                    <th scope="col">id card back</th>
                                    <th scope="col">role</th>
                                    <th scope="col">wallet</th>

                                </tr>
                            </thead>
                            <tbody id="transaction-tbody">    
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    const urlAllAccount = 'http://localhost/api/admin/list-account'
    const urlPendingAccount = 'http://localhost/api/admin/list-account/pending'
    const urlActivedAccount = 'http://localhost/api/admin/list-account/actived'
    const urlDisabledAccount = 'http://localhost/api/admin/list-account/disabled'
    const urluserDetails = 'http://localhost/api/admin/user-details/'
    
    function renderData(url = ''){
        fetch(url)
            .then(response => response.json())
            .then(response => {
                if(response.status == true){
                    $('#tbody__details').html(response.data.map((element) => {
                        const createdTime = new Date(element.createdAt *1000) 
                        const createdString = createdTime.getDate()
                                                +"/"+(createdTime.getMonth()+1)
                                                +"/"+createdTime.getFullYear()
                                                +" "+createdTime.getHours()
                                                +":"+createdTime.getMinutes()
                                                +":"+createdTime.getSeconds()
                        console.log(element.phoneNumber)
                        if(element.role == 'pending'){
                            return `
                            <tr>
                                <td>${element.email}</td>
                                <td class="align-middle">
                                    ${element.phoneNumber}
                                </td>
                                <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                                <td class="align-middle">${element.fullname}</td>
                                <td>${element.gender}</td>
                                <td class="align-middle">${createdString}</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-theme btn_show" data-toggle="modal" data-target="#modal__details" onclick="userdetails(` + element.phoneNumber +`)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#orderUpdate"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            `
                        }else if(element.role == 'actived'){
                            return `
                            <tr>
                                <td>${element.email}</td>
                                <td class="align-middle">
                                    ${element.phoneNumber}
                                </td>
                                <td class="align-middle"><span class="badge badge-success">Actived</span></td>
                                <td class="align-middle">${element.fullname}</td>
                                <td>${element.gender}</td>
                                <td class="align-middle">${createdString}</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-theme btn_show" data-toggle="modal" data-target="#orderInfo" onclick="userdetails(` + element.phoneNumber +`)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#orderUpdate"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            `
                        }else{
                            return `
                            <tr>
                                <td>${element.email}</td>
                                <td class="align-middle">
                                    ${element.phoneNumber}
                                </td>
                                <td class="align-middle"><span class="badge badge-success">Disable</span></td>
                                <td class="align-middle">${element.fullname}</td>
                                <td>${element.gender}</td>
                                <td class="align-middle">${createdString}</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-theme btn_show" data-toggle="modal" data-target="#orderInfo" onclick="userdetails(` + element.phoneNumber +`)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#orderUpdate"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            `
                        }
                    }))
                }else{
                    $('#tbody__details').html(response.msg)
                }
            })
       
    }
    renderData(urlAllAccount);
    function renderPendingData(){
        renderData(urlPendingAccount)
    }
    function renderActivedData(){
        renderData(urlActivedAccount)
    }
    function renderDisabledData(){
        renderData(urlDisabledAccount)
    }
    function renderAllAccountData(){
        renderData(urlAllAccount)
    }
  
    function userdetails(phoneNumber){
        fetch(urluserDetails + '0' + phoneNumber)
            .then(response => response.json())
            .then(response => {
                console.log(response)
                if(response.status){
                    const createdTime = new Date(response.data.createdAt *1000) 
                    const createdString = createdTime.getDate()
                                            +"/"+(createdTime.getMonth()+1)
                                            +"/"+createdTime.getFullYear()
                                            +" "+createdTime.getHours()
                                            +":"+createdTime.getMinutes()
                                            +":"+createdTime.getSeconds()
                    const bithday =  new Date(response.data.birthday *1000)
                    const bithdayString = bithday.getDate()
                                            +"/"+(createdTime.getMonth()+1)
                                            +"/"+createdTime.getFullYear()
                                            +" "+createdTime.getHours()
                                            +":"+createdTime.getMinutes()
                                            +":"+createdTime.getSeconds() 
                    $('#transaction-tbody').html(`
                        <tr>
                            <th scope="row">${response.data.email}</th>
                            <td>${response.data.phoneNumber}</td>
                            <td>${response.data.fullname}</td>
                            <td>${response.data.gender}</td>
                            <td>${response.data.address}</td>
                            <td>${bithdayString}</td>
                            <td>
                                <a href="${response.data.idCard_front}">
                                    <img src="${response.data.idCard_front}" alt="Don't have card user" width="50" height="50">
                                </a>
                            </td>
                            <td>
                                <a href="${response.data.idCard_back}">
                                    <img src="${response.data.idCard_back}" alt="Don't have card user" width="50" height="50">
                                </a>
                            </td>
                            <td>${response.data.role}</td>
                            <td>${response.data.wallet}</td>
                        </tr>
                    `
                    )
                }
            })
    }

</script>