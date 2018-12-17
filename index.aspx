<%@ Page Language="C#" AutoEventWireup="true" CodeFile="index.aspx.cs" Inherits="_index" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head runat="server">
    <meta charset="UTF-8">
    <meta name="keywords" content="programming, languages,
        programming languages, c++, python, c, java, computer science, computing">
    <meta name="description" content="This site provides programming languages comparison,
        description, tricks, trivia and much more">
    <title>Programming polyglot</title>

    <link rel="stylesheet" href="common/css/commonStyle.css" type="text/css">
    <link rel="stylesheet" href="css/mainStyle.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Kodchasan" rel="stylesheet">
    <style>
        figcaption > a {
            font-size: 10pt;
            text-decoration: none;
        }

        figcaption > a:hover {
            font-size: 150%;
        }
    </style>
    <script src="js/mainScript.js" type="text/javascript"></script>
</head>
<body>
    <header class="mainHeader">
        <figure id="logoFig">
            <a href="ftp://sunsite.icm.edu.pl/pub/CPAN/ls-lR.gz" download>
                <img id="logoImg" src="img/programming_polyglot.jpeg" width="480" height="270"
                     alt="Programming polyglot">
            </a>
            <figcaption>Source:
                <a href="https://blog.lelonek.me/be-a-polyglot-programmer-6e7423916ed8">
                    https://blog.lelonek.me/be-a-polyglot-programmer-6e7423916ed8
                </a>
            </figcaption>
        </figure>
        <h1><em>Welcome to programming polyglot online!</em></h1>
        <form method="get" action="https://google.com/search?q=" target="_blank" autocomplete="on">
            <p>
                <label style="font-family: tahoma, helvetica, sans-serif; ">
                    <span style="text-decoration: underline; font-size: 1.25em;">Google search:</span>
                    <input id="mainGSearch" name="q" type="search" placeholder="Google search">
                </label>
                <input name="submit" type="submit" value="Search">
            </p>
        </form>
    </header>
    <hr>

    <section id="navigation">
        <h3>Site navigation:</h3>
        <nav>
            <ul>
                <li><a href="#aboutSite">About this page</a></li>
                <li><span class="liCont">Languages sections</span>
                    <ol>
                        <script type="text/javascript">
                            var langs = ["C++", "C", "Java", "Python"];
                            for(var i = 0; i < langs.length; i++)
                            {
                                var lang = langs[i];
                                var page = lang.toLowerCase() + '.html';
                                page = page.replace("c++", "cpp");
                                document.writeln('<li><a href=\"languages/' + page + '\">' + lang + ' section</a>');
                                document.writeln('<ul>');
                                document.writeln('<li><a href="languages/' + page + '#aboutCpp">About ' + lang + '</a></li>');
                                document.writeln('<li><a href="languages/' + page + '#appsCpp">' + lang + ' applications</a></li>');
                                document.writeln('</ul>');
                                document.writeln('</li>');
                            }
                        </script>
                        <li><a href="languages/comparison.html">Languages comparison</a></li>
                    </ol>
                </li>
                <li><span class="liCont">Wikipedia</span>
                    <ol>
                        <li><a href="https://en.wikipedia.org/wiki/C%2B%2B">C++ Wikipedia</a></li>
                        <li><a href="https://en.wikipedia.org/wiki/C_(programming_language)">C Wikipedia</a></li>
                        <li><a href="https://en.wikipedia.org/wiki/Java_(programming_language)">Java Wikipedia</a></li>
                        <li><a href="https://en.wikipedia.org/wiki/Python_(programming_language)">Python Wikipedia</a></li>
                    </ol>
                </li>
                <li><a href="store/webstore.html">Webstore</a></li>
                <li id="contactLI"><a href="#contactInfo">Contact information</a></li>
            </ul>
        </nav>
    </section>
    <hr>

    <section id="aboutSite">
        <h3>About this page</h3>
        <p>
            This page provides information about few popular programming languages and theirs applications.
        </p>
        <article>
            <h4>What is programming language?</h4>
            <p>
                A programming language is a formal language, which comprises a set of instructions used to produce various kinds of output.
                Programming languages are used to create programs that implement specific algorithms. Most programming languages consist of
                instructions for computers, although there are programmable machines that use a limited set of specific instructions, rather than
                the general programming languages of modern computers. Early ones preceded the invention of the digital computer, the first
                probably being the automatic flute player described in the 9th century by the brothers Musa in Baghdad, during the Islamic Golden Age.
                From the early 1800s, programs were used to direct the behavior of machines such as Jacquard looms, music boxes and player pianos.
                However, their programs (such as a player piano's scrolls) could not produce different behavior in response to some input or condition.
            </p>
        </article>
    </section>
    <hr>
    <div id="allLinks"></div>
    <hr>
    <footer id="contactInfo">
        <address>
            Contact mail address:
            <a href="mailto:sample@mail.com">sample@mail.com</a>
        </address>
        <h4><del>&copy;</del> Przemysław Szeliński, no rights at all.</h4>
    </footer>
</body>
</html>
