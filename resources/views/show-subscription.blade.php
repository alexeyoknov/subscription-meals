<html lang="en">
  <head>
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  </head>
  <body>


    <div class="container panel panel-default ">
      <h2 class="panel-heading">{{ $title }}</h2>
      <ul>

        <? $subscriptionsTypes = config('subscription-vars.subscriptionType'); ?>
        @foreach($subscriptions as $subscription)
          <li>
            ФИО: {{ $subscription->fio }}
          </li>
          <li>
            Телефон: {{ $subscription->phone }}
          </li>
          <li>
            Название: {{ $subscription->mealsName }}
          </li>
          <li>
            Дата подписки: {{ $subscription->orderDate }}
          </li>
          <li>
            Начало периода: {{ $subscription->periodStart }}
          </li>
          <li>
            Конец периода: {{ $subscription->periodEnd }}
          </li>
          <li>
            Тип подписки: <?echo __('subscription.'.$subscriptionsTypes[$subscription->subscriptionType]);?>
          </li>
          <li>
            Дни доставки: {{ \App\Http\Controllers\SubscriptionMealsController::weekDays($subscription->days) }}
          </li>
          <li>
            Комментарий: {{ $subscription->comment }}
          </li>
        @endforeach

      </ul>
      Даты доставок:
      <ul>
        @foreach($dates as $d)
          <li>{{ $d }}</li>
        @endforeach
      </ul>
      <div class="form-group">
        <button class="btn btn-default" id="newSubscription" type="button"
          onclick="document.location.href='/new-subscription-meals'">Добавить подписку</button>
        @if ($id !== 'none' )
         <button class="btn btn-default" id="showSubscription" type="button"
           onclick="document.location.href='/'">Показать все подписки</button>
        @endif
      </div>
    </div>
  </body>
</html>
