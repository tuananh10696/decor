<style>
    .sch-select-input {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        margin-top: 1px;
        min-width: 180px;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-12 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Search</h4>
                        <p class="card-description">
                            Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a single horizontal row
                        </p>
                        <form class="form-inline">
                            <div class="input-group mr-sm-3 mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">Product Name</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                            </div>
                            <div class="form-group mr-sm-3 mt-2 mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">Category</span>
                                    <select class="form-control form-control-sm sch-select-input">
                                        <option>All</option>
                                        <option>Nội Thất</option>
                                        <option>Trang Trí</option>
                                        <option>Hoa</option>
                                        <option>Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mr-sm-3 mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">Status</span>
                                    <select class="form-control form-control-sm sch-select-input">
                                        <option>All</option>
                                        <option>Publish</option>
                                        <option>Draff</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col text-center mt-2">
                                <button type="submit" class="btn btn-primary mb-2">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product List</h4>
                        <p class="card-description">Product Quantity <code>3307</code></p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>First name</th>
                                        <th>Progress</th>
                                        <th>Amount</th>
                                        <th>Deadline</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1"><img src="/admin/images/faces/face1.jpg" alt="image"></td>

                                        <td><a href="/admin/stores/edit">May 15, 2015 </a></td>

                                        <td>Herman Beck</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td><a href="">Delete</a></td>
                                    </tr>
                                    <tr>
                                        <a href="/admin/stores/edit">
                                            <td class="py-1">
                                                <img src="/admin/images/faces/face2.jpg" alt="image">
                                            </td>
                                            <td>
                                                Messsy Adam
                                            </td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                $245.30
                                            </td>
                                            <td>
                                                July 1, 2015
                                            </td>
                                        </a>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>