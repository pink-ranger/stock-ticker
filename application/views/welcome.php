<!-- Display two tables. One with a list of all the stock and their value and 
another with a list of players, their equity and cash. -->
<div id="contents">
    <h1>Home</h1>
    <h2>Round: {round}</h2>
    <div class="row">
        <div class="col-md-6 table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Stock</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    {stocks}
                    <tr>
                        <td><a href="/stocks/{Code}">{Code}</a></td>
                        <td>${Value}</td>
                    </tr>
                    {/stocks}
                </tbody>
            </table>
        </div>
        <div class="col-md-6 table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Equity</th>
                        <th>Cash</th>
                    </tr>
                </thead>
                <tbody>
                    {players}
                    <tr>
                        <td><a href="/Players/{Player}">{Player}</a></td>
                        <td>${Equity}</td>
                        <td>${Cash}</td>
                    </tr>
                    {/players}
                </tbody>
            </table>
        </div>
    </div>
    Recent Movements:
    <div class="row">
        <div class="col-md-6 table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>DateTime</th>
                        <th>Stock</th>
                        <th>Action</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
            <!-- Display all data from movements table. -->
                    {movements}
                    <tr>
                        <td>{datetime}</td>
                        <td><a href="/stocks/{Code}">{code}</a></td>
                        <td>{action}</td>
                        <td>{amount}</td>
                    </tr>
                    {/movements}
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
    <!-- The table that displays all the player's transactions. -->
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
                        <td>{datetime}</td>
                        <td><a href="/stocks/{stock}">{stock}</a></td>
                        <td>{trans}</td>
                        <td>{quantity}</td>
                    </tr>
                    {/transactions}
                </tbody>
            </table>
        </div>
    </div>
</div>