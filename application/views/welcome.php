<div id="contents">
    <h1>Home</h1>
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
</div>