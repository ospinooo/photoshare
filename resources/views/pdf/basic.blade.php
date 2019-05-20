<style type="text/css" media="all">
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display";
  letter-spacing: 5px;
  text-align: center;
}
</style>



<h1>{{$title}}</h1>
<table class="table table-striped table-hover table-users">
  <thead>
    <tr>
    @foreach (array_keys($data[0]->getAttributes()) as $title)
      @if ($title != 'password' && $title!='email_verified_at' && $title!='remember_token')
        <th class="hidden-phone">{{$title}}</th>
      @endif
    @endforeach
    </tr>
  </thead>

  <tbody>
    @foreach ($data as $model)
      <tr>
        @foreach ($model->getAttributes() as $key => $value)
          @if ($key != 'password' && $key!='email_verified_at' && $key!='remember_token')
            <td class="hidden-phone">{{$value}}</td>
          @endif
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
