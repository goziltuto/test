<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spending;
use App\Models\Income;
use App\Models\Type;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index(Request $request){

        /**************************検索機能***********************/
        $query = Auth::user()->spending();
        $queryIncome = Auth::user()->income();

        if ($request->has('from') && $request->has('until')) {
            $from = $request->input('from');
            $until = $request->input('until');

            $query->whereBetween('date', [$from, $until]);
            $queryIncome->whereBetween('date', [$from, $until]);
        }

        $spends = $query->get();
        $incomes = $queryIncome->get();
        /********************************************************/

        // Eloquent
        // モデルのインスタンスを生成し、変数spendingに代入
        $spending = new Spending;
        $income = new Income;
        // spendingsモデルから全レコードを取得　配列化
        $types = Type::pluck('name', 'id'); // typesテーブルのidとnameの組み合わせを取得

        return view('home',[
            'spends' => $spends,
            'incomes' => $incomes,
            'types' => $types,
        ]);
    }
    public function spendDetail(Spending $spending){
        // 押された行の詳細ページを表示
        return view('spending', [
            'spend' => $spending,
        ]);
    }

    public function incomeDetail(Income $income){
        // 押された行の詳細ページを表示
        return view('income', [
            'income' => $income
        ]);
    }
}