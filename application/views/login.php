<!-- Display dropdown with a list of players. Selecting a player simulates 
the login process -->
<div id="contents">
    <h1>Login</h1>
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Login
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
      {players}
        <li><a href="/login/log_in/{Player}">{Player}</a></li>
      {/players}
      </ul>
    </div>
</div>