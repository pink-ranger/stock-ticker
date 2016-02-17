<div id="contents">
    <div id="tagline" class="clearfix">
        <h1>This is the home page</h1>
        <div>
            <table class="table">
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
                        <td>{Value}</td>
                    </tr>
                    {/stocks}
                </tbody>
            </table>
        </div>
        <div>
            <table class="table">
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
                        <td><a href="/player/{Player}">{Player}</a></td>
                        <td>{Equity}</td>
                        <td>{Cash}</td>
                    </tr>
                    {/players}
                </tbody>
            </table>
        </div>
    </div>
</div>