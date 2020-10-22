<div class="table-responsive">
    <table  id="datatable" class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
        </tr>
      </thead>
      <tbody>
      @foreach($data as $item)
        <tr>
          <td>{{$item->nama}}</td>
          <td>{{$item->phone}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>