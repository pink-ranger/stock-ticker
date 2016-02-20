<div id="contents">
    <div>
        {playerName}
            <h1>Player: {Player}
            <br/>
                <small class="text-muted">Cash: {Cash}</small>
                <small class="text-muted">Equity: {Equity}</small>
            </h1>
        {/playerName}
    </div>

    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Players
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
            {playerList}
                <li><a href="/Players/{Player}">{Player}</a></li>
            {/playerList}
        </ul>
    </div>
    
    <br/>
    
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>DateTime</th>
                        <th>Stock</th>
                        <th>Transaction</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    {transactions}
                    <tr>
                        <td>{DateTime}</td>
                        <td>{Stock}</td>
                        <td>{Trans}</td>
                        <td>{Quantity}</td>
                    </tr>
                    {/transactions}
                </tbody>
            </table>
        </div>
    </div>
</div>