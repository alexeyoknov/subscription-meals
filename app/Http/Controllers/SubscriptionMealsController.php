<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionMeals;
use Illuminate\Support\Facades\App;


class SubscriptionMealsController extends Controller
{
    public static function weekDayName($dayIndex){
        $weekArray = ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'];
        return $weekArray[$dayIndex];
    }

    public static function weekDays(string $days){

        $indexes = \explode(' ',$days);
        $weekDays = [];
        foreach($indexes as $ind)
            $weekDays[] = self::weekDayName($ind);

        return \implode(' ', $weekDays);
    }

    /**
     * Get Allowed Dates
     *
     * @param string $periodStart
     * @param string $periodEnd
     * @param string $days
     * @param integer $subType
     * @return array
     */
    private function getDates(string $periodStart, string $periodEnd, string $days, int $subType) {
        $from = new \DateTime($periodStart);
        $to   = new \DateTime($periodEnd);

        $allowedDays = explode(' ',$days);

        $period = new \DatePeriod($from, new \DateInterval('P1D'), $to);

        $arrayOfDates = array_map(
            function($item){return $item->format('Y-m-d');},
            iterator_to_array($period)
        );

        $arrayOfAllowedDates = [];
        $curIndex = 0;
        foreach($arrayOfDates as $date){
            if (in_array(date('w', \strtotime($date)), $allowedDays)) {
                switch ($subType) {
                    case 0:
                        $arrayOfAllowedDates[] = $date;
                        break;
                    case 1:
                    case 2:
                        if ($curIndex < $subType) {
                            $arrayOfAllowedDates[] = $date;
                        };
                        $curIndex++;
                        if ($curIndex == ($subType+1))
                            $curIndex = 0;
                        break;
                };

            };
        }

        return $arrayOfAllowedDates;
    }

    /**
     * Получить список подписок
     *
     * @return void
     */
    public function show() {

        $subscription = SubscriptionMeals::all();
        $title = 'Список всех подписок';

        return view('subscription')->with(['subscriptions'=>$subscription,'title'=>$title,'id'=>'none']);
    }

    /**
     * Показать информацию о подписке
     *
     * @param [type] $id
     * @return void
     */
    public function showSubscription($id) {
        App::setLocale('ru');
        $subscription = SubscriptionMeals::all()->where('id',$id);
        $title = 'Информация о подписке: ' . $subscription[$id-1]->fio;

        $dates = $this->getDates($subscription[$id-1]->periodStart, $subscription[$id-1]->periodEnd, $subscription[$id-1]->days, $subscription[$id-1]->subscriptionType);

        return view('show-subscription')->with([
                'subscriptions'=>$subscription,
                'title'=>$title,
                'id'=>$id,
                'dates'=>$dates
            ]);
    }

    /**
     * Показ главной страницы
     *
     * @return void
     */
    public function index() {
        App::setLocale('ru');
        $subscription = SubscriptionMeals::all();
        $title = 'Доступные подписки';
        return view('index')->with([
            'subscriptions'=>$subscription,
            'id'=>'none',
            'title' => $title
        ]);
    }


    /**
     * Форма для добавления подписки
     *
     * @return void
     */
    public function create() {
        App::setLocale('ru');
        return view('add-subscription');
    }


    /**
     * Добавление новой подписки
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $this->validate($request,[
            'fio' => 'required',
            'phone' => 'required',
            'mealsName' => 'required',
            'periodStart' => 'required',
            'periodEnd' => 'required',
            'subscriptionType' => 'required',
        ]);

        $subscription = new SubscriptionMeals;

        $data = $request->all();

        //convert days to array

        $data['days'] = implode(' ',$request->input('days'));
        $subscription->fill($data);
        $subscription->save();

        return redirect('/');
    }
}
