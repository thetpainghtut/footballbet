{{-- <div>
    If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius
</div> --}}

<ul class="list-group my-4">
          <li class="list-group-item active"> Leagues </li>
          @foreach($leagues as $league)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{-- English Premier League --}}
            {{$league->name}}
            <span class="badge badge-primary badge-pill">14</span>
          </li>
          @endforeach
          {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
            Spanish La Liga
            <span class="badge badge-primary badge-pill">2</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            German Bundesliga
            <span class="badge badge-primary badge-pill">1</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Italian Serie A
            <span class="badge badge-primary badge-pill">1</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            French Ligue 1
            <span class="badge badge-primary badge-pill">1</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Dutch Eredivisie
            <span class="badge badge-primary badge-pill">1</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Chinese Super League
            <span class="badge badge-primary badge-pill">1</span>
          </li> --}}
        </ul>