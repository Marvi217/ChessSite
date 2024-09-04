<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/forum.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <?php require("menu.php"); ?>

    <div class="panel_forum">
        <div class="forum">
            <div class="forum-header">
                <h1>Forum</h1>
            </div>
            <div>
                <form id="searchForm">
                    <div class="wkurw">
                        <input type="text" id="searchInput" name="fraza" placeholder="Szukaj">
                    </div>
                </form>
            </div>

            <a href="#" class="creat-subject">Utwórz nowy temat</a>

            <div id="searchResults"></div>

            <div class="new_thred">
                <h1>Utwórz nowy wątek</h1>
                <form action="insertSubject.php" method="post" id="new_subject">
                    <label for="tytul">Tytuł wątku:</label>
                    <input type="text" id="tytul" name="tytul" required>
                    <label for="tresc">Treść:</label>
                    <textarea name="tresc" id="tresc"></textarea>
                    <input type="submit" value="Utwórz">
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.new_thred').hide();

            function toggleNewThreadForm() {
                const newThreadDiv = $('.new_thred');
                const searchResultsDiv = $('#searchResults');
                const createSubjectLink = $('.creat-subject');

                if (newThreadDiv.is(':visible')) {
                    newThreadDiv.hide();
                    searchResultsDiv.show();
                    createSubjectLink.text('Utwórz nowy temat');
                } else {
                    searchResultsDiv.hide();
                    newThreadDiv.show();
                    createSubjectLink.text('Powrót');
                }
            }

            function loadAllThreads() {
                $.get('search.php?query=', function(data) {
                    const resultsDiv = $('#searchResults');
                    resultsDiv.empty();

                    if (data.length > 0) {
                        const ul = $('<ul></ul>');
                        $.each(data, function(index, item) {
                            const li = $('<li></li>');
                            const a = $('<a></a>').attr('href', 'subject.php?id=' + item.id).html(`${item.temat} przez ${item.nick}<br><small>Utworzono ${item.data_utworzenia}</small>`);
                            li.append(a);
                            ul.append(li);
                        });
                        resultsDiv.append(ul);
                    } else {
                        resultsDiv.html('<p>Brak wątków.</p>');
                    }
                });
            }

            $('#searchInput').on('input', function() {
                const query = $(this).val();

                $.get('search.php', { query: query }, function(data) {
                        const resultsDiv = $('#searchResults');
                        resultsDiv.empty();

                        if (data.length > 0) {
                            const ul = $('<ul></ul>');
                            $.each(data, function(index, item) {
                                const li = $('<li></li>');
                                const a = $('<a></a>')
                                    .attr('href', 'subject.php?id=' + item.id)
                                    .html(`${item.temat} przez ${item.nick}<br><small>Utworzono ${item.data_utworzenia}</small>`);
                                li.append(a);
                                ul.append(li);
                            });
                            resultsDiv.append(ul);
                        } else {
                            resultsDiv.html('<p>Brak wątków odpowiadających zapytaniu.</p>');
                        }
                    });
            });

            $('.creat-subject').on('click', function(event) {
                event.preventDefault();
                toggleNewThreadForm();
            });

            loadAllThreads();
        });
    </script>

    <?php require("footer.php"); ?>
</body>
</html>
