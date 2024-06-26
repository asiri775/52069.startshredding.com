@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/products') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Update Product</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <form method="POST" action="{!! action('ProductController@update',['product' => $product->id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name<span class="required">*</span>
                                    <p class="small-label">(In Any Language)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="title" value="{{$product->title}}" placeholder="e.g Atractive Stylish Jeans For Women" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="mainid" id="maincats" required>
                                        <option value="">Select Main Category</option>
                                        @foreach($categories as $category)
                                            @if($product->category[0] == $category->id)
                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="subid" id="subs">
                                        <option value="">Select Sub Category</option>
                                        @foreach($subs as $sub)
                                            @if($product->category[1] == $sub->id)
                                                <option value="{{$sub->id}}" selected>{{$sub->name}}</option>
                                            @else
                                                <option value="{{$sub->id}}">{{$sub->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="childid" id="childs">
                                        <option value="">Select Child Category</option>
                                        @foreach($child as $data)
                                            @if($product->category[2] == $data->id)
                                                <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                            @else
                                                <option value="{{$data->id}}">{{$data->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Current Featured Image <span class="required">*</span>
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                   <img style="max-width: 250px;" src="{{url('assets/images/products')}}/{{$product->feature_image}}" id="adminimg" alt="No Featured Image Added">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input onchange="readURL(this)" id="uploadFile" name="photo" type="file">
                                    {{--<div id="uploadTrigger" onclick="uploadclick()" style="white-space: normal;" class="form-control btn btn-default"><i class="fa fa-upload"></i> Add Featured Image</div>--}}
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="galdel" value="1"/>
                                            Delete Old Gallery Images</label>
                                    </div>

                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Product Gallery Images <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" accept="image/*" name="gallery[]" multiple/>
                                    <br>
                                    <p class="small-label">Multiple Image Allowed</p>
                                </div>
                            </div>
                            @if($product->sizes != null)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="pallow" id="allow" value="1" checked><strong>Allow Product Sizes</strong></label>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group" id="pSizes">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Sizes<span class="required">*</span>
                                    <p class="small-label">(Write your own size Separated by Comma[,])</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="sizes" value="{{$product->sizes}}" data-role="tagsinput"/>
                                </div>
                            </div>
                            @else
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="pallow" id="allow" value="1"><strong>Allow Product Sizes</strong></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="item form-group" id="pSizes" style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Sizes<span class="required">*</span>
                                        <p class="small-label">(Write your own size Separated by Comma[,])</p>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="sizes" value="X,XL,XXL,M,L,S" data-role="tagsinput"/>
                                    </div>
                                </div>
                            @endif

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="is_tiers" id="tiers" value="1" <?php echo (isset($product->is_tiers))?'Checked="Checked"':''?>><strong>Allow Services Tiers</strong></label>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group" id="pTiers" style="display: none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Services Tiers<span class="required">*</span>
                                    <p class="small-label">(In {{$settings[0]->currency_code}})</p>
                                </label>
                                <?php
                                $priceList = unserialize($product->tiers);
                                ?>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <label for="name">Standard</label>
                                    <input class="form-control col-md-2 col-xs-2" name="standard" placeholder="e.g 20"  value="{{$priceList['standard']}}"/><br>

                                    <label for="name">Flex</label>
                                    <input class="form-control col-md-2 col-xs-2" name="flex" placeholder="e.g 20" value="{{$priceList['flex']}}"/><br>

                                    <label for="name">Expedited</label>
                                    <input class="form-control col-md-2 col-xs-2" name="expedited" placeholder="e.g 20" value="{{$priceList['expedited']}}"/>

                                    <input type="hidden" name="isTiers" id="isTiers" value="1">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="description" id="description" class="form-control" rows="6">{{$product->description}}</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Current Price<span class="required">*</span>
                                    <p class="small-label">(In {{$settings[0]->currency_code}})</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="price" value="{{$product->price}}" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="text">
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Plant Cost<span class="required">*</span>
                                    <p class="small-label">(In {{$settings[0]->currency_code}})</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="plant_cost" value="{{$product->plant_cost}}" placeholder="e.g 20" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Previous Price<span class="required">*</span>
                                    <p class="small-label">(In {{$settings[0]->currency_code}}, Leave Blank if not Required)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="previous_price" value="{{$product->previous_price}}" placeholder="e.g 25" pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                           title="Price must be a numeric or up to 2 decimal places." type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Stock<span class="required">*</span>
                                    <p class="small-label">(Leave Empty will Show Always Available)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="stock" value="{{$product->stock}}" placeholder="e.g 15" pattern="[0-9]{1,10}" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Buy/Return Policy<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="policy" id="policy" class="form-control" rows="6">{{$product->policy}}</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Tags<span class="required">*</span>
                                    <p class="small-label">(Write your product tags Separated by Comma[,])</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="tags" value="{{$product->tags}}" data-role="tagsinput"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12" data-toggle="buttons">
                                    @if($product->featured == 1)
                                        <label class="btn btn-default active">
                                            <input type="checkbox" name="featured" value="1" autocomplete="off" checked>
                                            <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span>
                                            Add to Featured Product
                                        </label>
                                    @else
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="featured" value="1" autocomplete="off">
                                            <span class="go_checkbox"><i class="glyphicon glyphicon-ok"></i></span>
                                            Add to Featured Product
                                        </label>
                                    @endif
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="add_ads" type="submit" class="btn btn-success btn-block">Update Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@stop

@section('footer')
    <script>
        bkLib.onDomLoaded(function() {
            new nicEditor().panelInstance('description');
            new nicEditor().panelInstance('policy');
        });

        $("#allow").change(function () {
            $("#pSizes").toggle();
        });


        $("#tiers").change(function () {
            $("#pTiers").toggle();
        });


        var ckbox = $('#tiers');
        $('input[name=follow]').attr('checked', false);
        $('input').on('click',function () {
            if (ckbox.is(':checked')) {
                $("#isTiers").val(1);
            } else {
                $("#isTiers").val(0);
            }
        });


        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adminimg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop