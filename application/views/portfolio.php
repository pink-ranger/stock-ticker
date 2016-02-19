<div id="contents">
    <div id="tagline" class="clearfix">
    
        <div>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Players
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    {playerList}
                        <li><a href="/Players/{Player}">{Player}</a></li>
                    {/playerList}
                </ul>
            </div>
            
            <div>
                {playerName}
                    <h2>Player: {Player}</h2>
                    <h3>Cash: {Cash}</h3>
                    <h3>Equity: {Equity}</h3>
                {/playerName}
            </div>
            
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
    </div>
</div>