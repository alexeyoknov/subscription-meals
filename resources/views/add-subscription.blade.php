<html lang="en">
  <head>
    <title>Добавление новой подписки</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  </head>
  <body>

    @if (count($errors)>0)
      <div class='alert alert-danger'>
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <? $cur_date=date('Y-m-d');?>
    <div class="container panel panel-default ">
      <h2 class="panel-heading">Добавление новой подписки</h2>
      <form id="newSubscriptionForm" method=POST action="{{route('subscriptionStore')}}">
        <div class="form-group">
          <label for="fio">ФИО:</label>
          <input type="text" name="fio" class="form-control" placeholder="ФИО" id="fio">
        </div>

        <div class="form-group">
          <label for="phone">Телефон:</label>
          <input type="tel" id="phone" name="phone" class="form-control" placeholder="+7(123) 456-67-89" pattern="+[0-9]([0-9]{3}) [0-9]{3}-[0-9]{2}-[0-9]{2}" required="" maxlength=12>
        </div>

        <div class="form-group">
          <label for="mealsName">Название рациона питания:</label>
          <input type="text" name="mealsName" class="form-control" placeholder="Название рациона питания" id="mealsName">
        </div>

        <div class="form-group">
          <label for="periodStart">Начало периода подписки:</label>
          <input type="date" name="periodStart" class="form-control" placeholder="Начало периода" id="periodStart" value="<?echo $cur_date;?>">
        </div>

        <div class="form-group">
          <label for="periodEnd">Окончание периода подписки:</label>
          <input type="date" name="periodEnd" class="form-control" placeholder="Окончание периода" id="periodEnd" value="<?echo $cur_date;?>">
        </div>

        <div class="form-group">
          <label for="subscriptionType">Расписание доставки:</label>
          <select name="subscriptionType" class="form-control" id="subscriptionType">
            <? $subscriptionsTypes = \App\Http\Controllers\SubscriptionMealsController::subscriptionTypes(); ?>
            @foreach($subscriptionsTypes as $key => $val)
              <option value={{ $key }}><? echo __('subscription.'.$val);?></option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="days">Дни доставки:</label>
          <select name="days[]" class="form-control" id="days[]" multiple size="7">
            @foreach([1=>'Пн',2=>'Вт',3=>'Ср',4=>'Чт',5=>'Пт',6=>'Сб',0=>'Вс'] as $key => $val)
              <option value={{ $key }}><? echo __($val);?></option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="comment">Комментарий:</label>
          <textarea rows=5 name="comment" class="form-control" placeholder="Комментарий" id="comment"></textarea>
        </div>

        <div class="form-group">
          <button class="btn btn-default" id="submit" type=submit>Добавить</button>

          <button class="btn btn-default" id="showSubscriptions" type="button"
            onclick="document.location.href='/'">Показать все подписки</button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>
 </body>
</html>
