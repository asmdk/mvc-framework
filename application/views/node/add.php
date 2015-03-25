<h1>Create Node</h1>

<?php if (empty($attributes)) : ?>
    <div id="header_lower">
        <form class="form" method="post">
            <div class="row row-block" id="fieldTitleContainer">
                <label for="fieldTitle">Title</label>
                <input id="fieldTitle" type="text" name="node[title]" value="">
            </div>
            <div class="row row-block" id="fieldBodyContainer">
                <label for="fieldBody">Текст</label>
                <textarea id="fieldBody" name="node[body]"></textarea>
            </div>
            <div class="submit">
                <input type="submit" value="Send" />
            </div>
        </form>
    </div>
<?php else : ?>
    <div class="message confirm">Запись успешно добавлена! <a href="">Добавить еще</a> </div>
<?php endif; ?>
