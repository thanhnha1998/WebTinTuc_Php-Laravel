 @extends('admin.layout.index')

 @section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                         @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                            {{$err}}<br>
                            @endforeach
                        </div>
                        @endif
                        @if(session('thongbao'))
                        <div class="alert alert-success">
                        {{session('thongbao')}} </div>
                        @endif
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai">
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="LoaiTin">
                                    @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Hãy nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea class="form-control" name="TomTat" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <label class="radio-inline">
                                    <textarea id="demo" class="form-control ckeditor" name="NoiDung"rows="3"></textarea>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="Hinh" class="form-control">
                            </div>
                             <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input type="radio" name="NotBat" value="0" checked="">Không
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="NotBat" value="0" checked="">Có
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mớit</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        @endsection
{{--         @section('script')
        <script>
            $(document).ready(function(){
                $("#TheLoai").change(function(){
                    var idTheLoai = $(this).val();
                    alert("a");
                });
            });
        </script>
        @endsection --}}