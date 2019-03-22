@extends('layout')
@section('title', '献立アイテム登録')
@section('content')
    <!--nav-->
    @include('nav', ['jump' => '週間献立', 'jumplink' => '/' ])
    <!--header-->
    <div class="container-fluid">
    <!--documents-->
      <div class="row">
        <div class="col-xs-12 col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">献立アイテム登録</h3>
            </div>
            <div class="panel-body">
              <div class="content-row">
                <div class="row">
                  

                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <form method="POST" action="/master"> 
                    {{csrf_field()}}

                      <div class="row">
                        <div class="col-xs-6 col-sm-3">
                          <h4>カテゴリ</h4>
                          <div class="radio">
                            <input type="radio" id="flat-radio-1" name="category" value="1">
                            <label for="flat-radio-1">主食</label>
                            <input type="radio" id="flat-radio-1" name="category" value="2">
                            <label for="flat-radio-1">メイン</label>
                            <input type="radio" id="flat-radio-3" name="category" value="3">
                            <label for="flat-radio-3">副菜</label>
                            <input type="radio" id="flat-radio-4" name="category" value="4">
                            <label for="flat-radio-4">その他</label>
                          </div>
                          <div id="button_area">
                            <div class="row">
                              <div class="col-xs-6 col-sm-4">
                                <button type="submit" class="btn btn-default btn-sm">登録</button>
                              </div>
                              <div class="col-xs-6 col-sm-4">
                                <button type="reset" class="btn btn-default btn-sm">クリア</button>
                              </div>
                              <div class="col-xs-12 col-sm-4">
                                <button type="button" class="btn btn-default btn-sm">キャンセル</button>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                          <h4>名前</h4>
                          <input type="text" class="form-control" name="menu_name" placeholder="唐揚げ">
                        </div>
                        
                        <div class="col-xs-12 col-sm-6">
                          <h4>献立リンク</h4>
                          <input type="text" class="form-control" name="link" placeholder="http://">
                        </div>
                      </div>
                    </form> 
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">アイテム一覧</div>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>主食</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                              @if($shushoku)
                                @foreach($shushoku as $val)
                                <button type="button" class="btn btn-warning">{{$val->menu_name}}</button>
                                @endforeach
                              @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>メイン</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                              @if($maindish)
                                @foreach($maindish as $val)
                                <button type="button" class="btn btn-danger">{{$val->menu_name}}</button>
                                @endforeach
                              @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>副菜</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                              @if($fukusai)
                                @foreach($fukusai as $val)
                                <button type="button" class="btn btn-success">{{$val->menu_name}}</button>
                                @endforeach
                              @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>その他</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                              @if($other)
                                @foreach($other as $val)
                                <button type="button" class="btn btn-info">{{$val->menu_name}}</button>
                                @endforeach
                              @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- panel body -->
          </div>
        </div><!-- content -->
      </div>
    </div>
    <!--footer-->
    <footer>
      <div class="container">
        <div class="copyright clearfix text-center">
          <p>&copy; Yoshida</p>
        </div>
      </div>
    </footer>
@endsection