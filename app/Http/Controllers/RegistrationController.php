<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Spending;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateData;
use App\Http\Requests\CreateTypeData;

class RegistrationController extends Controller
{
    public function createSpendForm(){
        $params = Type::where('category', '0')->get();

        return view('spends.spend_form', [
            'types' => $params,
        ]);
    }

    public function createIncomeForm(){
        $params = Type::where('category', '1')->get();
        
        return view('incomes.income_form', [
            'types' => $params,
        ]);
    }

    // カテゴリー入力
    public function createTypeForm($category){
        $params = Type::where('category', $category)->get();
        
        return view('create_type', [
            'types' => $params,
        ]);
    }
    
    public function createSpend(CreateData $request){
        $spending = new Spending;

        // リファクタリング版
        $columns = ['amount', 'date', 'type_id', 'comment'];
        foreach($columns as $column){
            $spending->$column = $request->$column;
        }

        Auth::user()->spending()->save($spending);

        return redirect('/');
    }

    public function createIncome(CreateData $request){
        $income = new Income;

        $income->amount = $request->amount;
        $income->date = $request->date;
        $income->type_id = $request->type_id;
        $income->comment = $request->comment;

        Auth::user()->income()->save($income);

        return redirect('/');
    }

    // カテゴリーの追加処理
    public function addType(CreateTypeData $request){
        // 直前のページのURLから最後のセグメントを取得する
        $segments = $request->segments();
        $lastSegment = end($segments);

        // 最後のセグメントが0または1であればそれをカテゴリとして設定する
        $category = ($lastSegment === '0' || $lastSegment === '1') ? intval($lastSegment) : 0;

        // フォームから送信された分類データを取得
        $name = $request->input('category');

        // 新しい分類データを作成して保存
        $type = new Type;
        $type->name = $name;
        $type->category = $category; // リンクのcategoryの値を代入
        $type->user_id = Auth::user()->type(); // user_idカラムに現在のuserIDを代入

        Auth::user()->type()->save($type);

        
        // 収入か支出か確認してリダイレクト 収入＝1,支出＝0
        if($category == 1){
            return redirect('/create_income');
        }else if($category == 0){
            return redirect('/create_spend');
        }
    
    }

    // 編集内容の入力
    public function editSpendForm(Spending $spending){
        $type = 0;
        $subject = '支出';

        $types = Type::where('category', $type)->get();

        return view('spends.spend_edit', [
            'id' => $spending->id,
            'subject' => $subject,
            'result' => $spending,
            'types' => $types,
            'selectedCategoryId' => $spending->type_id, // 選択されたカテゴリーのIDを渡す
        ]);
    }

    // 更新処理をforeachで処理する(リファクタリング)
    public function editSpend(int $id, CreateData $request){
        $instance = new Spending;
        $record = $instance->find($id);

        $columns = ['amount', 'date', 'type_id', 'comment'];

        foreach($columns as $column){
            $record->$column = $request->$column;
        }
        $record->save();

        return redirect('/');
    }

    // 対象を削除してリダイレクトする
    public function deleteSpend(int $id){
        $instance = new Spending;
        $record = $instance->find($id);

        // forceDeleteで物理削除
        $record->forceDelete();

        return redirect('/');;
    }
    // 対象を削除してリダイレクトする
    public function SoftDeleteSpend(int $id){
        $instance = new Spending;
        $record = $instance->find($id);

        // deleteで論理削除
        $record->delete();

        return redirect('/');;
    }

    // 編集内容の入力
    public function editIncomeForm(Income $income){
        $type = 1;
        $subject = '収入';

        $types = Type::where('category', $type)->get();

        return view('incomes.income_edit', [
            'id' => $income->id,
            'subject' => $subject,
            'result' => $income,
            'types' => $types,
            'selectedCategoryId' => $income->type_id, // 選択されたカテゴリーのIDを渡す
        ]);
    }
    
    // 更新処理をforeachで処理する(リファクタリング)
    public function editIncome(int $id, CreateData $request){
        $instance = new Income;
        $record = $instance->find($id);

        $columns = ['amount', 'date', 'type_id', 'comment'];

        foreach($columns as $column){
            $record->$column = $request->$column;
        }
        $record->save();

        return redirect('/');
    }

    // 対象を削除してリダイレクトする
    public function deleteIncome(int $id){
        $instance = new Income;
        $record = $instance->find($id);

        // forceDeleteで物理削除
        $record->forceDelete();

        return redirect('/');
    }

    // 対象を削除してリダイレクトする
    public function SoftDeleteIncome(int $id){
        $instance = new Income;
        $record = $instance->find($id);

        // deleteで論理削除
        $record->delete();

        return redirect('/');
    }

}
