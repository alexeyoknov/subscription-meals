<html lang="en">
  <head>
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container panel panel-default ">
      <h2 class="panel-heading">{{ $title }}</h2>
      <table class="table table-striped table-hover">
        <thead>
        <?
          $subscriptionsTypes = config('subscription-vars.subscriptionType');
          $tableHeader = ['ФИО','Телефон','Название','Дата заказа','Тип подписки','Комментарий', ''];
          foreach($tableHeader as $th){
              echo "<th>" . $th . "</th>";
          };
        ?>
        </thead>
        <tbody>
        @foreach($subscriptions as $subscription)
          <tr>
            <td> {{ $subscription->fio }} </td>
            <td> {{ $subscription->phone }} </td>
            <td> {{ $subscription->mealsName }} </td>
            <td> {{ $subscription->orderDate }} </td>
            <td> <?echo __('subscription.'.$subscriptionsTypes[$subscription->subscriptionType]);?></td>
            <td> {{ $subscription->comment }} </td>
            <td><a href="/subscription-meals/{{ $subscription->id }}">Подробно</a></td>
          </tr>
        @endforeach</tbody>
        </table>
      <div class="form-group">
        <button class="btn btn-default" id="newSubscription" type="button"
          onclick="document.location.href='/new-subscription-meals'">Добавить подписку</button>
      </div>
    </div>
  </body>
</html>
