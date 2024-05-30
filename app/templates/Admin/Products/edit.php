
<div class="main-panel">
    <div class="content-wrapper">
        <h3 class="card-title text-center m-2 mb-4">Product Edit</h3>

        <?= $this->Form->create($product, ['type' => 'file', 'url' => ['action' => 'edit']]) ?>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Description</h4>
                        <p class="card-description">
                            Add classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.
                        </p>
                        <div class="form-group">
                            <label>Large input</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username">
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label>Basic</label>
                                <div id="the-basics">
                                    <span class="twitter-typeahead" style="position: relative; display: inline-block;"><input class="typeahead tt-hint" type="text" readonly="" autocomplete="off" spellcheck="false" tabindex="-1" dir="ltr" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box padding-box rgb(255, 255, 255);"><input class="typeahead tt-input" type="text" placeholder="States of USA" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;">
                                        <pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Nunito, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
                                        <div class="tt-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;">
                                            <div class="tt-dataset tt-dataset-states"></div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <label>Bloodhound</label>
                                <div id="bloodhound">
                                    <span class="twitter-typeahead" style="position: relative; display: inline-block;"><input class="typeahead tt-hint" type="text" readonly="" autocomplete="off" spellcheck="false" tabindex="-1" dir="ltr" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box padding-box rgb(255, 255, 255);"><input class="typeahead tt-input" type="text" placeholder="States of USA" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;">
                                        <pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Nunito, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
                                        <div class="tt-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;">
                                            <div class="tt-dataset tt-dataset-states"></div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Textarea</label>
                            <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Membership</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked="">
                                        Free
                                        <i class="input-helper"></i></label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2">
                                        Professional
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sales</h4>
                        <p class="card-description">Checkbox and radio controls (default appearance is in primary color)</p>

                        <div class="form-group row">
                            <div class="w-100 pl-3">
                                <label>Category</label>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" checked="">
                                        a
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" checked="">
                                        ProfessionalProfeal ProfessionalProfeal
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" checked="">
                                        Professional Professional
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" checked="">
                                        Professional
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" checked="">
                                        Professional
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <?= $this->Form->file('images[]', ['multiple' => true, 'id' => 'file-input']) ?>
                        </div>
                        <div id="preview" class="row"></div>
                    </div>
                </div>
            </div>

            <div class="col text-center">
                <button type="submit" class="btn btn-primary mr-2">Add Product</button>
                <button class="btn btn-warning">Product List</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<!-- sử dụng bootrap, jquery và cakephp 4 tôi muốn tạo 1 input vs name là images cho phép upload nhiều ảnh cùng 1 lúc với các chức năng sau:
- preview ảnh được upload
- có nút xoá và di chuyển vị trí bức ảnh
- ảnh được lưu vào database tại table files
- hash tên của ảnh để tránh bị trùng lặp tên ảnh và tôi có thể tạo ra 2 ảnh với 2 size khác nhau cho mỗi ảnh, 1 ảnh với size gốc lưu ở cột images và 1 ảnh với size 150 x 150 lưu vào cột thumbnail -->
