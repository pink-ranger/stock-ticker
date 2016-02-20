<div id="contents">
    <h1>History</h1>
    <!-- Dropdown for navigating to other stock history pages. -->
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Stocks
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
	<!-- Loop through all stock names and make link to the page. -->
        {stockNames}
            <li><a href="/stocks/{Code}">{Code}</a></li>
        {/stockNames}
        </ul>
    </div>
    
    <br />

    <div class="row">
        <div class="table-responsive">
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
