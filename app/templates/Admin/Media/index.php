<style>
    .sch-select-input {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        margin-top: 1px;
        min-width: 180px;
    }

    .ad-list-img {
        width: 100px !important;
        height: 96px !important;
        border-radius: 10% !important;
    }

    .message.success {
        text-align: center;
        margin-bottom: 1.2rem;
        text-transform: capitalize;
        font-size: 1.125rem;
        font-weight: 600;
        color: #FFC100 !important;
    }

    .upload__inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .upload__btn {
        display: inline-block;
        font-weight: 600;
        color: #fff;
        text-align: center;
        min-width: 116px;
        padding: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid;
        background-color: #4045ba;
        border-color: #4045ba;
        border-radius: 10px;
        line-height: 26px;
        font-size: 14px;
    }

    .upload__btn:hover {
        background-color: unset;
        color: #4045ba;
        transition: all 0.3s ease;
    }

    .upload__btn-box {
        margin-bottom: 10px;
    }

    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .upload__img-box {
        width: 140px;
        padding: 0 10px;
        margin-bottom: 12px;
    }

    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__img-close:after {
        content: '\2716';
        font-size: 14px;
        color: white;
    }

    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
    }
</style>
<?php

use Cake\I18n\I18n; ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4">Media Upload</h3>
                        <?= $this->Form->create(null, ['url' => ['controller' => 'Media'], 'type' => 'file']) ?>
                        <div class="col text-center">
                            <div class="upload__box pt-0">
                                <div class="upload__btn-box">
                                    <label class="upload__btn">
                                        <?= $this->Form->file('images[]', ['multiple' => true, 'class' => 'upload__inputfile btn btn-outline-danger btn-icon-text']) ?>
                                        <i class="ti-upload btn-icon-prepend"></i>
                                        Select Files
                                    </label>
                                    <button type="submit" class="btn btn-primary">Upload Files</button>
                                </div>
                                <div class="upload__img-wrap col text-center"></div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>


                    </div>
                </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2>Media Library</h2>
                        <h5 class="card-description">
                            The total number of files is now<code> 20</code> posts.
                        </h5>
                        <?= $this->Flash->render() ?>

                        <div class="d-flex justify-content-between align-items-center">
                            <form class="form-inline d-flex w-100">
                                <div class="form-group mr-sm-5 mt-2 mb-0">
                                    <div class="input-group-prepend">
                                        <select class="form-control form-control-sm sch-select-input">
                                            <option>Selected Action</option>
                                            <option>Delete Selected</option>
                                            <option>Publish Selected</option>
                                            <option>Draff Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group mr-sm-3 mt-2">
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                                <div class="col mt-2">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                                <div class="d-flex justify-content-end ml-auto">
                                    <div class="input-group mr-sm-3 mt-2">
                                        <div class="input-group-prepend">
                                            <select class="form-control form-control-sm sch-select-input">
                                                <option>Limit Posts</option>
                                                <option>50</option>
                                                <option>100</option>
                                                <option>150</option>
                                                <option>200</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>





                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="pb-1">
                                            <div class="form-check form-check-success">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input">
                                                    Select All
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </th>
                                        <th>Image</th>
                                        <th>Created</th>
                                        <th>Name</th>
                                        <th>Alt</th>
                                        <th>Author</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($files as $file) : ?>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-success">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input">
                                                </div>
                                            </td>
                                            <td class="py-2">
                                                <img class="ad-list-img" src="<?= IMG_PATH_THUMB . $file->image ?>" alt="image">
                                            </td>
                                            <td><?= $file->created->i18nFormat('HH:mm dd/MM/yyyy') ?></td>
                                            <td class="ad-post-name"><?= h($file->image) ?></td>
                                            <td class="ad-post-alt"><?= h($file->alt) ?>Lấy danh sách ảnh từ cơ sở dữ liệuLấy danh sách ảnh từ cơ sở dữ liệuLấy danh sách ảnh từ cơ sở dữ liệu</td>
                                            <td><?= h($file->author) ?></td>
                                            <td><?= h($file->author) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-secondary">1</button>
                                <button type="button" class="btn btn-outline-secondary">2</button>
                                <button type="button" class="btn btn-outline-secondary">3</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>