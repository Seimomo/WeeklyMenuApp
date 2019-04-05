@extends('layout')
@section('title', '週間献立')
@section('content')
    <!--nav-->
    @include('nav', ['jump' => '献立アイテム登録', 'jumplink' => '/master' ])
    <!--header-->
    <div class="container-fluid">

    <!--documents-->
      <div class="row">
        <div class="col-xs-12 col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">献立</h3>
            </div>
            <div class="panel-body">
              <div class="content-row">
                <div class="row">
                  

                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <!-- 朝のメニューリスト追加フォーム -->
                    <form name="frm1list" method="POST" action="/add">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="menu_name1">
                    </form> 
                    <!-- 昼のメニューリスト追加フォーム -->
                    <form name="frm2list" method="POST" action="/add">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="menu_name2">
                    </form> 
                    <!-- 夜のメニューリスト追加フォーム -->
                    <form name="frm3list" method="POST" action="/add">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="menu_name3">
                    </form> 
                    
                    <!-- 朝の自由入力追加フォーム -->
                    <form name="frm4list" method="POST" action="/add">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="menu_name4">
                    </form> 
                    <!-- 昼の自由入力追加フォーム -->
                    <form name="frm5list" method="POST" action="/add">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="menu_name5">
                    </form> 
                    <!-- 夜の自由入力追加フォーム -->
                    <form name="frm6list" method="POST" action="/add">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="menu_name6">
                    </form>
                    
                    <!-- 編集フォーム -->
                     <form name="frm7list" method="POST" action="/edit"> 
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="edit_date">
                     </form>

                    <form method="POST" action="/"> 
                    {{csrf_field()}}
                      <div class="row">
                        <div class="col-xs-6 col-sm-3">
                          <h4  for="day">日付</h4>
                          <input type="text" class="form-control"  id="day" name="edit_date">
                          <h4>メモ(イベント等)</h4>
                          <input type="text" class="form-control" name="event_name" placeholder="誕生日、飲み会...">
                          <div id="button_area">
                            <div class="row">
                              
                                <button type="submit" class="btn btn-primary btn-sm">登録</button>


                                <button type="reset" class="btn btn-primary btn-sm">クリア</button>


                                <!--<button type="button" class="btn btn-primary btn-sm">キャンセル</button>-->

                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                          </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                          <h4>朝ごはん</h4>
                          <div class="checkbox">
                            <input type="checkbox" id="flat-checkbox-1" name="chk1_1" value="1">
                            <label for="flat-checkbox-1">パン</label>
                            <input type="checkbox" id="flat-checkbox-1" name="chk1_2" value="1">
                            <label for="flat-checkbox-1">ごはん</label>
                    			 <div class="input-group">
                    			   {{Form::select('sel1', [
                    			     '（選択してください）',
                                '主食' => $shushoku,
                                'メイン' => $maindish,
                                '副菜' => $fukusai,
                                'その他' => $other
                              ],null,['class'=>'form-control', 'id' => 'selecter_1'])}}

                        			<div class="input-group-btn">
                                <button type="button" id="breakfast-select-plus" class="btn btn-dafult" tabindex="-1"
                                  onclick="btn1_list_add();">+</button>
                              </div>
                            </div>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="ラーメン" id=free_menu1>
                              <div class="input-group-btn">
                                <button type="button" id="breakfast-edit-plus" class="btn btn-dafult" tabindex="-1"
                                  onclick="btn4_list_add();">+</button>
                              </div>
                            </div>
                            <ul class="list-group" style="border: 1px solid #AAB2BD; border-radius: 4px;">
                              @if(isset($edit1list1))
                                @foreach($edit1list1 as $val)
                                <li class="list-group-item">{{$val}}</li>
                                @endforeach
                              @endif
                              
                            </ul>
                          </div>
                        </div>
                        
                        <div class="col-xs-6 col-sm-3">
                          <h4>昼ごはん</h4>
                          <div class="checkbox">
                            <input type="checkbox" id="flat-checkbox-2" name="chk2_1" value="1">
                            <label for="flat-checkbox-1">パン</label>
                            <input type="checkbox" id="flat-checkbox-2" name="chk2_2" value="1">
                            <label for="flat-checkbox-1">ごはん</label>
                    			 <div class="input-group">
                    			   {{Form::select('sel2', [
                    			     '（選択してください）',
                                '主食' => $shushoku,
                                'メイン' => $maindish,
                                '副菜' => $fukusai,
                                'その他' => $other
                              ],null,['class'=>'form-control', 'id' => 'selecter_2'])}}

                        			<div class="input-group-btn">
                                <button type="button" id="lunch-select-plus" class="btn btn-dafult" tabindex="-1"
                                  onclick="btn2_list_add();">+</button>
                              </div>
                            </div>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="ラーメン" id=free_menu2>
                              <div class="input-group-btn">
                                <button type="button" id="lunch-edit-plus" class="btn btn-dafult" tabindex="-1"
                                  onclick="btn5_list_add();">+</button>
                              </div>
                            </div>
                            <ul class="list-group" style="border: 1px solid #AAB2BD; border-radius: 4px;">
                              @if(isset($edit1list2))
                                @foreach($edit1list2 as $val)
                                <li class="list-group-item">{{$val}}</li>
                                @endforeach
                              @endif
                              
                            </ul>
                          </div>
                        </div>
                        
                        <div class="col-xs-6 col-sm-3">
                          <h4>夜ごはん</h4>
                          <div class="checkbox">
                            <input type="checkbox" id="flat-checkbox-3" name="chk3_1" value="1">
                            <label for="flat-checkbox-1">パン</label>
                            <input type="checkbox" id="flat-checkbox-3" name="chk3_2" value="1">
                            <label for="flat-checkbox-1">ごはん</label>
                    			 <div class="input-group">
                    			   {{Form::select('sel3', [
                    			     '（選択してください）',
                                '主食' => $shushoku,
                                'メイン' => $maindish,
                                '副菜' => $fukusai,
                                'その他' => $other
                              ],null,['class'=>'form-control', 'id' => 'selecter_3'])}}

                        			<div class="input-group-btn">
                                <button type="button" id="dinner-select-plus" class="btn btn-dafult" tabindex="-1"
                                  onclick="btn3_list_add();">+</button>
                              </div>
                            </div>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="ラーメン" id=free_menu3>
                              <div class="input-group-btn">
                                <button type="button" id="dinner-edit-plus" class="btn btn-dafult" tabindex="-1"
                                  onclick="btn6_list_add();">+</button>
                              </div>
                            </div>
                            <ul class="list-group" style="border: 1px solid #AAB2BD; border-radius: 4px;">
                              @if(isset($edit1list3))
                                @foreach($edit1list3 as $val)
                                <li class="list-group-item">{{$val}}</li>
                                @endforeach
                              @endif
                              
                            </ul>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">献立表示</div>
                     
                        <table class="table">
                          <thead>
                            <tr>
                              <th class="col-sm-2 col-md-2 col-lg-2">日付</th>
                              <th class="col-sm-3 col-md-3 col-lg-3">朝/昼/夜</th>
                              <th class="col-sm-3 col-md-3 col-lg-3">メニュー</th>
                              <th class="col-sm-3 col-md-3 col-lg-3">メモ</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($weekMenu as $val)
                            <tr>
                                <td>{{$val->cooking_date}}</td>
                                <td @if($val->kind == '1')class="danger" @elseif($val->kind == '2')class="warning" @else class="info"@endif>
                                  @if ($val->kind == '1')
                                      朝
                                  @elseif ($val->kind == '2')
                                      昼
                                  @else
                                      夜
                                  @endif
                                </td>
                                <td>{{$val->menu_name}}</td>
                                <td>{{$val->event_name}}</td>
                            </tr>
                            @endforeach
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                <div class="row">

                  <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="panel-heading">編集</div>
                    {{Form::select('eventday', 
                      $eventday
                    ,null,['class'=>'form-control', 'id' => 'selecter_7'])}}
                  <button type="submit" class="btn btn-primary btn-sm" onclick="editview();">編集</button>
                  </div>
                </div>
                <form method="POST" action="/editsave"> 
                  {{csrf_field()}}
                    <!-- 編集input要素数　朝 -->
                  <input type="hidden" name="editlist_1_cnt" @if(isset($editmenulist_breakfast))value={{count($editmenulist_breakfast)}}@endif>
                  <!-- 編集input要素数　昼 -->
                  <input type="hidden" name="editlist_2_cnt" @if(isset($editmenulist_lunch))value={{count($editmenulist_lunch)}}@endif>
                  <!-- 編集input要素数　夜 -->
                  <input type="hidden" name="editlist_3_cnt" @if(isset($editmenulist_dinner))value={{count($editmenulist_dinner)}}@endif>
                  <div class="row">
                    <div class="col-xs-6 col-sm-3">
                      <h4>日付</h4>
                      <input type="text" id="day_edit" class="form-control" name="edit_date_view" value="{{isset($editday)?$editday:''}}">
                      <h4>メモ(イベント等)</h4>
                      <input type="text" class="form-control" name="event_name_view" @if(isset($editname))value="{{$editname}}"@endif>
                      <div id="button_area">
                        <div class="row">
                          
                            <button type="submit" class="btn btn-primary btn-sm">編集保存</button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                      <h4>朝ごはん</h4>
                        <ul class="list-group" style="border: 1px solid #AAB2BD; border-radius: 4px;">
                            @if(isset($editmenulist_breakfast))
                              <?php $cnt_1 = 0; ?>
                              @foreach($editmenulist_breakfast as $menu)
                              <li class="list-group-item">
                                <input type="text" class="form-control" id=1 name="editlist_1_{{$cnt_1}}" value="{{$menu}}">
                              </li>
                               <?php $cnt_1++; ?>
                              @endforeach
                            @endif
                            
                          </ul>
                			   {{Form::select('sel4', [
                  			     '（選択してください）',
                              '主食' => $shushoku,
                              'メイン' => $maindish,
                              '副菜' => $fukusai,
                              'その他' => $other
                            ],null,['class'=>'form-control', 'id' => 'selecter_4'])}}
                    </div>
                    
                    <div class="col-xs-6 col-sm-3">
                      <h4>昼ごはん</h4>
                        <ul class="list-group" style="border: 1px solid #AAB2BD; border-radius: 4px;">
                            @if(isset($editmenulist_lunch))
                            <?php $cnt_2 = 0; ?>
                              @foreach($editmenulist_lunch as $menu)
                              <li class="list-group-item">
                                <input type="text" class="form-control" id=2 name="editlist_2_{{$cnt_2}}" value="{{$menu}}">
                              </li>
                              <?php $cnt_2++; ?>
                              @endforeach
                            @endif
                            
                          </ul> 
                			   {{Form::select('sel5', [
                  			     '（選択してください）',
                              '主食' => $shushoku,
                              'メイン' => $maindish,
                              '副菜' => $fukusai,
                              'その他' => $other
                            ],null,['class'=>'form-control', 'id' => 'selecter_5'])}}
                    </div>
                    
                    <div class="col-xs-6 col-sm-3">
                      <h4>夜ごはん</h4>
                        <ul class="list-group" style="border: 1px solid #AAB2BD; border-radius: 4px;">
                            @if(isset($editmenulist_dinner))
                              <?php $cnt_3 = 0; ?>
                              @foreach($editmenulist_dinner as $menu)
                              <li class="list-group-item">
                                <input type="text" class="form-control" id=3 name="editlist_3_{{$cnt_3}}" value="{{$menu}}">
                              </li>
                              <?php $cnt_3++; ?>
                              @endforeach
                            @endif
                            
                          </ul> 
                  			   {{Form::select('sel6', [
                  			     '（選択してください）',
                              '主食' => $shushoku,
                              'メイン' => $maindish,
                              '副菜' => $fukusai,
                              'その他' => $other
                            ],null,['class'=>'form-control', 'id' => 'selecter_6'])}}
                    </div>
                  </div>
                </form>
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
          <p>&copy; TEST</p>
        </div>
      </div>
    </footer>
    <script>
      $( function() {
        $( "#day" ).datepicker({dateFormat: 'yy-mm-dd'});
        $( "#day_edit" ).datepicker({dateFormat: 'yy-mm-dd'});
      } );
    </script>
@endsection
