@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header">All Images</div>
                    <div class="card-body">
                        <table class="table ">
                            <tr>
                                <th>이미지</th>
                                <th>성명</th>
                                <th>Tel</th>
                                <th width="50" style="width:50px;">SNS</th>
                                {{--<th>업로드 시간</th>--}}
                                <th>출력안될시</th>
                            </tr>
                            @foreach ($images as $image)
                                <tr>
                                    <th>
                                        <picture>
                                            <source srcset="{{$image->url.'?w=500&h=500&q=70&f=webp'}}"
                                                    data-name="{{$image->name}}" data-tel="{{$image->tel}}" data-sns="{{$image->sns}}" data-date="{{$image->created_at}}"
                                                    type="image/webp" />
                                            <img src="{{$image->url}}"
                                                 data-name="{{$image->name}}" data-tel="{{$image->tel}}" data-sns="{{$image->sns}}" data-date="{{$image->created_at}}"/>
                                        </picture>
                                        {{--.replaceAll(' ','+').replaceAll('?','%3F')--}}
                                    </th>
                                    <td>{{$image->name}}</td>
                                    <td>{{$image->tel}}</td>
                                    <td width="50" style="width:50px;">{{$image->sns}}</td>
                                    {{--<td>{{$image->size_in_kb}} KB</td>--}}
                                    <td>{{$image->created_at}}</td>{{--uploaded_time--}}
                                    <td style="word-break: break-all">
                                        <a href="{{$image->url}}" target="_blank">{{$image->url}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $images->onEachSide(10)->links() }}
                        <a class="page-img-download text-2xl text-gray-500">페이지 이미지 다운로드</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <img id="images" alt="">


@endsection

@section('bottom-script')

    <script>
        /*window.addEventListener('load', function(){
            var cnvs = document.getElementById('cnvs');
            var ctx  = cnvs.getContext('2d');

            var img = new Image();
            img.src = 'https://d83zcgyzq29uq.cloudfront.net/images/2020-06-09/허수연__01040743919/XqEfyJdmcYTQGNFsr8pBImy2l3pNGmyb8eY8zJzG.jpeg';
            img.crossOrigin = "*";
            img.crossOrigin = 'Anonymous';
            img.onload = function(){

                // 캔버스에 이미지 그리기
                cnvs.width  = img.width;
                cnvs.height = img.height;
                ctx.drawImage(img, 0, 0);

                // 캔버스를 클릭하면 이미지 다운로드
                cnvs.addEventListener('click', function(){
                    var dataURL = cnvs.toDataURL('image/png');
                    dataURL = dataURL.replace(/^data:image\/[^;]*!/, 'data:application/octet-stream');
                    dataURL = dataURL.replace(/^data:application\/octet-stream/, 'data:application/octet-stream;headers=Content-Disposition%3A%20attachment%3B%20filename=Canvas.png');

                    var aTag = document.createElement('a');
                    aTag.download = 'from_canvas.png';
                    aTag.href = dataURL;
                    aTag.click();
                });

            }
        });*/

        /*String.prototype.replaceAll = function(org, dest) {
            return this.split(org).join(dest);
        }*/

        $(document).ready(function () {

            $('.page-img-download').on('click', function () {
                var cnt=0;
                var errorcnt=0;
                $('img').each(function () {
                    var xhr = new XMLHttpRequest();
                    var url = ($(this).attr('src'));

                    var name=$(this).data('name');
                    var tel=$(this).data('tel');
                    var sns=$(this).data('sns');
                    var date=$(this).data('date');

                   // console.log(($(this).attr('src')));
                    if(name!==undefined && tel!==undefined ){
                        cnt++;
                        setTimeout(function () {
                            xhr.open('GET', url, true);
                            xhr.responseType = 'blob';
                            xhr.setRequestHeader('Access-Control-Allow-Origin','*');

                            xhr.onload = function(e) {
                                if(xhr.readyState === XMLHttpRequest.DONE){
                                    if(xhr.status === 200 || xhr.status === 201){
                                        console.log((xhr.response));
                                    }else{
                                        console.error(xhr.responseText);
                                    }
                                    var blob = this.response;
                                    //window.navigator.msSaveOrOpenBlob(blob, 'new_file_name.png');

                                    var img = document.getElementById('images');
                                    img.onload = function(e) {
                                        window.URL.revokeObjectURL(img.src); // Clean up after yourself.
                                    };

                                    img.src = window.URL.createObjectURL(blob);
                                    img.style.display='none';
                                    var aTag = document.createElement('a');
                                    aTag.download = name+'/'+date+'.png';
                                    aTag.href = img.src;
                                    aTag.click();
                                }
                            };
                            xhr.send();
                            xhr.onerror = function() { errorcnt++; };
                        },cnt*400);

                    }
                });

            });
            $('img, source').on('click', function () {
                var xhr = new XMLHttpRequest();
                // var url = 'https://d83zcgyzq29uq.cloudfront.net/images/2020-06-09/허수연__01040743919/XqEfyJdmcYTQGNFsr8pBImy2l3pNGmyb8eY8zJzG.jpeg';
                var url = ($(this).attr('src'));
                var name=$(this).data('name');
                var tel=$(this).data('tel');
                var sns=$(this).data('sns');
                var date=$(this).data('date');
                //console.log(encodeURIComponent('-'));
                console.log(encodeURIComponent('='));

                xhr.open('GET', url, true);
                xhr.responseType = 'blob';
                xhr.setRequestHeader('Access-Control-Allow-Origin','*');

                xhr.onload = function(e) {
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200 || xhr.status === 201){
                            console.log((xhr.response));
                        }else{
                            console.error(xhr.responseText);
                        }
                        var blob = this.response;
                        //window.navigator.msSaveOrOpenBlob(blob, 'new_file_name.png');

                        var img = document.getElementById('images');
                        img.onload = function(e) {
                            window.URL.revokeObjectURL(img.src); // Clean up after yourself.
                        };

                        img.src = window.URL.createObjectURL(blob);
                        img.style.display='none';
                        var aTag = document.createElement('a');
                        aTag.download = name+'/'+date+'.png';
                        aTag.href = img.src;
                        aTag.click();

                        setTimeout(function () {
                            window.navigator.msSaveOrOpenBlob(blob,  name+'/'+tel+'.png');
                        },1000);
                    }
                };

                xhr.onerror = function() { alert('error'); };
                xhr.send();
            });
        });

    </script>
@endsection
