<?php

namespace App\Http\Controllers;

use App\Menu;
use App\WeekMenu;
use App\DayEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    // 週間献立画面の表示
    public function index(Request $request) {
        $menuList = $this->getMenuList();
        
        return view('page.index', array_merge($this->getWeekMenuList(),$menuList, $this->getEventDayList()));
    }
    
    // 献立アイテム画面の表示
    public function master(Request $request) {
        $shushoku = Menu::where('category', '1')->get();
        $maindish = Menu::where('category', '2')->get();
        $fukusai = Menu::where('category', '3')->get();
        $other = Menu::where('category', '4')->get();
        return view('page.master', ['shushoku' => $shushoku, 'maindish' => $maindish, 'fukusai' => $fukusai, 'other' => $other]);
    }

    
    public function postMenuMaster(Request $request) {
        
        // POSTで受信した献立マスタデータの登録
        $menu = new Menu(); 
        $menu->category = $request->category;
        $menu->menu_name = $request->menu_name;
        $menu->link = $request->link;         
        $menu->save();
        
        // 献立マスタデータ取得
        $shushoku = Menu::where('category', '1')->get();
        $maindish = Menu::where('category', '2')->get();
        $fukusai = Menu::where('category', '3')->get();
        $other = Menu::where('category', '4')->get();
        return view('page.master', ['shushoku' => $shushoku, 'maindish' => $maindish, 'fukusai' => $fukusai, 'other' => $other]);
    }
    
    //週間献立の登録前のメニュー追加（リスト・テキスト）
    public function postEditMenuList(Request $request) {
        //セッションに受け取ったメニューを入れる
        $menu_name1 = $request->menu_name1; // セレクト朝
        $menu_name2 = $request->menu_name2; // セレクト昼
        $menu_name3 = $request->menu_name3; // セレクト夜
        $menu_name4 = $request->menu_name4; // 自由入力朝
        $menu_name5 = $request->menu_name5; // 自由入力昼
        $menu_name6 = $request->menu_name6; // 自由入力夜
        
        //登録前リストを作成してViewに返す
        $menuList = $this->getMenuList();
        
        // セッションから値を取得
        session()->regenerate();
        
        
        if(session()->has('plusList1')) {
            $plusList1 = session('plusList1');
        } else {
            $plusList1 = array();
        }
        
        if(session()->has('plusList2')) {
            $plusList2 = session('plusList2');
        } else {
            $plusList2 = array();
        }
        
        if(session()->has('plusList3')) {
            $plusList3 = session('plusList3');
        } else {
            $plusList3 = array();
        }
        
        // 値があればアレイに追加、セッションに値を保存
        if(isset($menu_name1)) {
            array_push($plusList1, $menu_name1);
            session(['plusList1' => $plusList1]);
        }
        
         if(isset($menu_name4)) {
            array_push($plusList1, $menu_name4);
            session(['plusList1' => $plusList1]);
        }
        
        if(isset($menu_name2)) {
            array_push($plusList2, $menu_name2);
            session(['plusList2' => $plusList2]);
        }
        
        if(isset($menu_name5)) {
            array_push($plusList2, $menu_name5);
            session(['plusList2' => $plusList2]);
        }
        
        if(isset($menu_name3)) {
            array_push($plusList3, $menu_name3);
            session(['plusList3' => $plusList3]);
        }
        
        if(isset($menu_name6)) {
            array_push($plusList3, $menu_name6);
            session(['plusList3' => $plusList3]);
        }
        
        $editMenuList = ['edit1list1' => $plusList1, 'edit1list2' => $plusList2, 'edit1list3' => $plusList3];

        return view('page.index', array_merge($editMenuList,$menuList, $this->getWeekMenuList(),$this->getEventDayList()));

    }

    public function postWeeklyMenu(Request $request) {
        $validatedData = $request->validate([
            'edit_date' => 'required|date_format:Y-m-d',
            'event_name' => 'required',
        ]);
        
        //登録前リストを作成してViewに返す
        $menuList = $this->getMenuList();
        
        // POSTで受信した週間献立データの登録
        
        // 配列で登録された献立データを受け取る
        $weekMenuList = array();
        if (isset($request->chk1_1)) {
            //朝のパン
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $request->edit_date;
            $weekMenu->kind = "1";
            $weekMenu->menu_name = "パン";
            array_push($weekMenuList,$weekMenu);
        } 
        if (isset($request->chk1_2)) {
            //朝のごはん
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $request->edit_date;
            $weekMenu->kind = "1";
            $weekMenu->menu_name = "ごはん";
            array_push($weekMenuList,$weekMenu);
        }
        if (isset($request->chk2_1)) {
            //昼のパン
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $request->edit_date;
            $weekMenu->kind = "2";
            $weekMenu->menu_name = "パン";
            array_push($weekMenuList,$weekMenu);
        } 
        if (isset($request->chk2_2)) {
            //昼のごはん
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $request->edit_date;
            $weekMenu->kind = "2";
            $weekMenu->menu_name = "ごはん";
            array_push($weekMenuList,$weekMenu);
        }
        if (isset($request->chk3_1)) {
            //夜のパン
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $request->edit_date;
            $weekMenu->kind = "3";
            $weekMenu->menu_name = "パン";
            array_push($weekMenuList,$weekMenu);
        } 
        if (isset($request->chk3_2)) {
            //夜のごはん
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $request->edit_date;
            $weekMenu->kind = "3";
            $weekMenu->menu_name = "ごはん";
            array_push($weekMenuList,$weekMenu);
        }

        // セッションからの朝昼晩のメニューリストを取得        
        if(session()->has('plusList1')) {
            $plusList1 = session('plusList1');
            
            foreach($plusList1 as $plus) {
                $weekMenu = new WeekMenu(); 
                $weekMenu->cooking_date = $request->edit_date;
                $weekMenu->kind = "1";
                $weekMenu->menu_name = $plus;
                array_push($weekMenuList,$weekMenu);
            }
        } 
        
        if(session()->has('plusList2')) {
            $plusList2 = session('plusList2');
            
            foreach($plusList2 as $plus) {
                $weekMenu = new WeekMenu(); 
                $weekMenu->cooking_date = $request->edit_date;
                $weekMenu->kind = "2";
                $weekMenu->menu_name = $plus;
                array_push($weekMenuList,$weekMenu);
            }
            
        } 
        
        if(session()->has('plusList3')) {
            $plusList3 = session('plusList3');
            
            foreach($plusList3 as $plus) {
                $weekMenu = new WeekMenu();
                $weekMenu->cooking_date = $request->edit_date;
                $weekMenu->kind = "3";
                $weekMenu->menu_name = $plus;
                array_push($weekMenuList,$weekMenu);
            }
        }
        
        //朝・昼・夜の主食レコード作成
        foreach($weekMenuList as $weekMenu) {
            $weekMenu->save();
        }
        
        
        $dayEvent = new DayEvent(); 
        $dayEvent->event_date = $request->edit_date;
        $dayEvent->event_name = $request->event_name;
        $dayEvent->save();
        
        session()->flush();
        
       return view('page.index', array_merge($this->getWeekMenuList(),$menuList, $this->getEventDayList()));
       
       //return view('page.index', array_merge(['weekMenu' => $this->getWeekMenuList()],$menuList));
    }
 
     
    // 週間献立画面＋編集画面の表示
    public function postEditViewMenuList(Request $request) {
        $edit_day = $request->edit_date;
        $menuList = $this->getMenuList();
        
        // イベント名の取得
        $edit_event = DayEvent::where('event_date', $edit_day)->select('event_name')->first(); // event_name指定でエラーになる
        $edit_event_name = $edit_event->event_name;
        // $edit_event_name = array();
        // foreach($edit_event as $val) {
        //     array_push($edit_event_name,$val->event_name);
        // }
        
        // 編集日の朝ごはんを取得
        $edit_day_menu = WeekMenu::where('cooking_date', $edit_day)->where('kind', '1')->select('menu_name')->get();
        $edit_day_menulist1 = array();
        foreach($edit_day_menu as $val) {
            array_push($edit_day_menulist1,$val->menu_name);
        }
        
        // 編集日の昼ごはんを取得
        $edit_day_menu = WeekMenu::where('cooking_date', $edit_day)->where('kind', '2')->select('menu_name')->get();
        $edit_day_menulist2 = array();
        foreach($edit_day_menu as $val) {
            array_push($edit_day_menulist2,$val->menu_name);
        }
        
        // 編集日の夜ごはんを取得
        $edit_day_menu = WeekMenu::where('cooking_date', $edit_day)->where('kind', '3')->select('menu_name')->get();
        $edit_day_menulist3 = array();
        foreach($edit_day_menu as $val) {
            array_push($edit_day_menulist3,$val->menu_name);
        }
        
        return view('page.index', array_merge($this->getWeekMenuList(),$menuList, $this->getEventDayList(),
            ['editday' => $edit_day], ['editname' => $edit_event_name],
            ['editmenulist_breakfast' => $edit_day_menulist1], ['editmenulist_lunch' => $edit_day_menulist2], ['editmenulist_dinner' => $edit_day_menulist3])
        );
    }

// 週間献立画面＋編集画面の表示
    public function postDeleteMenu(Request $request) {
        $delete_day = $request->delete_date;
        $menuList = $this->getMenuList();
        
        // イベントの削除
        $delete_event = DayEvent::where('event_date', $delete_day)->delete(); 
        
        // 献立を削除
        $edit_day_menu = WeekMenu::where('cooking_date', $delete_day)->delete();
        
        
        return view('page.index', array_merge($this->getWeekMenuList(),$menuList, $this->getEventDayList()));
    }
    // 編集献立の保存   
    public function postEditSaveWeeklyMenu(Request $request) {
        $validatedData = $request->validate([
            'edit_date_view' => 'required|date_format:Y-m-d',
            'event_name_view' => 'required',
        ]);
        
        //登録前リストを作成してViewに返す
        $menuList = $this->getMenuList();
        
        // 日付、イベントの取得
        $edit_date_view = $request->edit_date_view;
        $event_name_view = $request->event_name_view;
        

        // 日付からすでに献立がある場合　⇒　g該当日の献立とイベントを削除
        $eventday_list = WeekMenu::where('cooking_date', $edit_date_view)->delete();
        $event_day = DayEvent::where('event_date', $edit_date_view)->delete();
        
        // 朝、昼、夜のinput編集後の値の取得
        $editMenuList = array();
        $list_cnt = $request->editlist_1_cnt;
        for ($i = 0; $i < $list_cnt; $i++) {
            //朝の編集献立
            $request_name = "editlist_1_".$i;
            
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $edit_date_view;
            $weekMenu->kind = "1";
            $weekMenu->menu_name = $request->$request_name;
            if (isset($weekMenu->menu_name)) {
                array_push($editMenuList,$weekMenu);
            }
        }
        $list_cnt = $request->editlist_2_cnt;
        for ($i = 0; $i < $list_cnt; $i++) {
            //朝の編集献立
            $request_name = "editlist_2_".$i;
            
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $edit_date_view;
            $weekMenu->kind = "2";
            $weekMenu->menu_name = $request->$request_name;
            if (isset($weekMenu->menu_name)) {
                array_push($editMenuList,$weekMenu);    
            }
        }
        $list_cnt = $request->editlist_3_cnt;
        for ($i = 0; $i < $list_cnt; $i++) {
            //朝の編集献立
            $request_name = "editlist_3_".$i;
            
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $edit_date_view;
            $weekMenu->kind = "3";
            $weekMenu->menu_name = $request->$request_name;
            if (isset($weekMenu->menu_name)) {
                array_push($editMenuList,$weekMenu);      
            }
        }
        
        // 朝、昼、夜のメニュープルダウン選択値の取得 TODO
        if( $request->sel4 != "0") {
            $menu = Menu::where('id',$request->sel4)->first();
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $edit_date_view;
            $weekMenu->kind = "1";
            $weekMenu->menu_name = $menu->menu_name;
            array_push($editMenuList,$weekMenu);
        }
        if( $request->sel5 != "0") {
            $menu = Menu::where('id',$request->sel5)->first();
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $edit_date_view;
            $weekMenu->kind = "2";
            $weekMenu->menu_name = $menu->menu_name;
            array_push($editMenuList,$weekMenu);
        }
        if( $request->sel6 != "0") {
            $menu = Menu::where('id',$request->sel6)->first();
            $weekMenu = new WeekMenu(); 
            $weekMenu->cooking_date = $edit_date_view;
            $weekMenu->kind = "3";
            $weekMenu->menu_name = $menu->menu_name;
            array_push($editMenuList,$weekMenu);
        }
        
        //朝・昼・夜の主食レコード作成
        foreach($editMenuList as $weekMenu) {
            $weekMenu->save();
        }
        
        $dayEvent = new DayEvent(); 
        $dayEvent->event_date = $edit_date_view;
        $dayEvent->event_name = $event_name_view;
        $dayEvent->save();
        
       return view('page.index', array_merge($this->getWeekMenuList(),$menuList, $this->getEventDayList()));
       
    }
    
    
    // 画面の献立を返す
    private function getWeekMenuList() {
        //return ['weekMenu' => WeekMenu::all()]; // viewにハッシュのキーを渡す必要あり
        return ['weekMenu' => WeekMenu::select()->join('day_events','day_events.event_date','=','week_menus.cooking_date')->orderBy('cooking_date', 'desc')->orderBy('kind', 'desc')->get()];
        //return WeekMenu::all();
    }
    
    // 週間献立画面のメニュープルダウンのリストを返す
    private function getMenuList() {
        $shushoku_list = Menu::where('category', '1')->get();
        $shushoku = array();
        foreach($shushoku_list as $val) {
            //array_push($shushoku,$val->menu_name);
            $shushoku[$val->id] = $val->menu_name;
        }
        $maindish_list = Menu::where('category', '2')->get();
        $maindish = array();
        foreach($maindish_list as $val) {
            //array_push($maindish,$val->menu_name);
            $maindish[$val->id] = $val->menu_name;
        }
        $fukusai_list = Menu::where('category', '3')->get();
        $fukusai = array();
        foreach($fukusai_list as $val) {
            //array_push($fukusai,$val->menu_name);
            $fukusai[$val->id] = $val->menu_name;
        }
        $other_list = Menu::where('category', '4')->get();
        $other = array();
        foreach($other_list as $val) {
            //array_push($other,$val->menu_name);
            $other[$val->id] = $val->menu_name;
        }
        return ['shushoku' => $shushoku, 'maindish' => $maindish, 'fukusai' => $fukusai, 'other' => $other];
    }
    
    // イベント日付リストを返す
    private function getEventDayList() {
        $eventdaylist =  DayEvent::orderBy('event_date', 'desc')->get();
        $event = array();
        foreach($eventdaylist as $val) {
            //$event = array_merge($event, array($val->event_id, $val->event_date));
            //array_push($event, $val->event_date);
            $event[$val->event_date] = $val->event_date;
        }
        return ['eventday' => $event]; // viewにハッシュのキーを渡す必要あり
    }
}
