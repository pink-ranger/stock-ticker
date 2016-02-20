<div id="contents">
    <h1>History</h1>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Stocks
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
        {stockNames}
            <li><a href="/stocks/{Code}">{Code}</a></li>
        {/stockNames}
        </ul>
    </div>
    
    <br />

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
                    {movements}
                    <tr>
                        <td>{Datetime}</td>
                        <td><a href="/stocks/{Code}">{Code}</a></td>
                        <td>{Action}</td>
                        <td>{Amount}</td>
                    </tr>
                    {/movements}
                </tbody>
            </table>
        </div>
    </div>
    
</div>