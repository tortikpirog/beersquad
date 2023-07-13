<script>
    function testJS() {
        fetch('/test/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({
                name: 'testName'
            })
        });
    }
</script>
<form action="/test/create" method="post">
    <input type="text" name="name" placeholder="vvedi imya">
    <button type="submit">жмяк</button>
    <button onclick="testJS">тут жаба</button>
</form>
<h1>
    <?php
    foreach ($GLOBALS['viewModel'] as $name) {
        echo '<p>' . $name . '</p>';

    } ?>
</h1>