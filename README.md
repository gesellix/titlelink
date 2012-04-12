# TitleLink content plugin

Written by [Tobias Gesellchen](http://www.gesellix.de/) with help on the documentation by [Marc Perkel](http://www.perkel.com/).

### Web links

[Joomla Extensions Directory](http://extensions.joomla.org/component/option,com\_mtree/task,viewlink/link\_id,427/Itemid,35/),

[Project site](https://github.com/gesellix/titlelink),
[Download](https://github.com/gesellix/titlelink/downloads),
[Wiki](https://github.com/gesellix/titlelink/wiki),
[Tracker](https://github.com/gesellix/titlelink/issues)

[Private homepage](http://www.gesellix.de/)

### Description

TitleLink is a Joomla System Plugin to easily create links in Joomla content to other Joomla content by Title or Alias.
By inserting text into your content like {ln:Growing African Violets} you link directly to your content with that title.
The purpose of this extension is to help create easy ways to drop links to content within the material that you are writing.

TitleLink is a must have to link between Joomla! articles without using cryptic hyperlinks. TitleLink also minimizes the risk of breaking article links when changes are made to the target article. In contrast to other extensions TitleLink doesn't need the article ids to find your article - so you always get exactly the right links.

### Installation

After installing the plugin through the extension manager be sure to publish the plugin to activate it.
Publishing the plugin is the way you turn it on.

### Using TitleLink

TitleLink is used by dropping shortcut references into your content that you are writing.
Suppose that you have written and published an article called "Growing African Violets".
You are now writing a new article about plants you can grow indoors, and you want to reference and link to your African Violet article.
You might use it this way: "If you don't have a lot of natural light you might try {ln:Growing African Violets}."
Basically, you use the target article title and wrap it between two curly braces and the prefix "ln:", which is short for "link:".

When the web page is displayed it will link to your article on violets.
Suppose however that the text you want to display isn't the same as the title you want to link to.
You can do it this way: "In low light I had good luck raising {ln:growing african violets 'violets} indoors."
This will show the link as "violets" but point to the content with the title "growing african violets".
Linking isn't case sensitive so you don't have to match case to make the link work.

Linking is not limited to the title. You can link to the title\_alias field as well.
If you used the word "violets" by itself in the title\_alias then all you would have to do to link to it is {ln:violets}.

When using JoomFish you always have to keep in mind that the translated titles aren't found by TitleLink.
That means you have to use the titles of the original articles even in the translated versions.
TitleLink only finds the original article, JoomFish changes it to the translated one.

By default, TitleLink will retry a search in all installed and activated plugins as configured in the plugin configuration.
This second try will search for partial matches, so one could have an article titled "One Two Three",
and a TitleLink {ln:one two} would find that article. To disable the retry, just use "em:" (for "exact match") as in {ln:em:one two}.
Using the title\_alias can be more convenient, when you have similar articles with similar titles. In such cases
it can be useful not only for TitleLink to manually set a unique title\_alias.

When the second try was a hit, TitleLink will use your partial phrase (e.g. "one two") as the displayed text.
To let TitleLink replace your phrase with the correct title of the article, use "rep:" (for "replace") as option.
{ln:rep:one two} would then create a link with "One Two Three" as displayed text.

TitleLink can be used as a shortcut for creating external links, too.
Rather than just putting a complete HTML anchor tag in your text you can easilly turn it into a link as follows: {ln:http://joomlacode.org/gf/project/titlelink/}

You can even have links open a new window with the nw: modifier. {ln:nw:http://joomlacode.org/gf/project/titlelink/}

Suppose however you want the link text to display something else. Here how you would do that: {ln:nw:http://joomlacode.org/gf/project/titlelink/ 'TitleLink at JoomlaCode}

You can create links to google, yahoo, wikipedia or site-internal searches by using the key words google, yahoo, wikipedia or search.
Other sites which support keywords are called by using the command search-&lt;selector&gt; where &lt;selector&gt; is one of the sites listed at the end of this document.

See the syntax and examples section for details!

### Syntax

TitleLink provides a syntax like follows. The examples use the default settings for prefix and suffix.
Parameters in square brackets '\[' and '\]' are optional, angle brackets '<' and '>' are obligatory.
The vertical bar '|' tells you to choose one of the options linked together. See the examples for a less technical description.

{ln\[:\]\[debug:\]\[nw:\]\[op:\]\[css-&lt;class&gt;:\]\[search-&lt;selector&gt;:\]\[append-&lt;to append&gt;:\]\[limitstart-&lt;page&gt;\]\[itemid-&lt;id&gt;:\]\[&lt;search|google|yahoo|wikipedia|em|rep&gt;:\]&lt;link/phrase&gt;\[ '&lt;text to display&gt;\[ ''&lt;tooltip to display&gt;\]\]}

<dl>
  <dt>nw:</dt><dd>"new window" - open links in a new window</dd>
  <dt>op:</dt><dd>"keep tag open" - supress the closing "&lt;/a&gt;". Useful, when you like to add some inner HTML content.</dd>
  <dt>css-&lt;class&gt;:</dt><dd>set a css-class "&lt;class&gt;"</dd>
  <dt>search-&lt;selector&gt;:</dt><dd>create a link to an external site/search engine. See below for supported &lt;selector&gt;s</dd>
  <dt>append-&lt;to append&gt;:</dt><dd> append to the link, useful for anchors like in http://www.example.com/index.php#anchor</dd>
  <dt>limitstart-&lt;page&gt;:</dt><dd>selects the page of an article with several pages. &lt;page&gt; starts with 1, which would be the first page of the article (index 0)</dd>
  <dt>itemid-&lt;id&gt;:</dt><dd>appends &lt;id&gt;, when TitleLink wasn't able to get an itemid by Joomla!</dd>
  <dt>search:</dt><dd>create a link to a site-internal search</dd>
  <dt>google/yahoo:</dt><dd>create link to a search by the search engine</dd>
  <dt>wikipedia:</dt><dd>create a search link for the english version of the wikipedia</dd>
  <dt>em:</dt><dd>"exact match" - disable searching for partial matches</dd>
  <dt>rep:</dt><dd>"replace title" - if a partial match was found and no &lt;text to display&gt; was given, display the complete title</dd>
</dl>

### Debugging

To help you (and me) debugging problems with TitleLink there are some commands available:

<dl>
  <dt>{ln:enable:false}</dt><dd>To disable TitleLink in an article, use the command somewhere inside that article.</dd>
  <dt>{ln:debug:&lt;phrase and other options&gt;}</dt><dd>Lets TitleLink show some debug information, if no link could be built.</dd>
</dl>

### Examples

1.  {ln:&lt;phrase&gt;}<br />
    create simple hyperlink with "phrase" as displayed text
2.  {ln:nw:&lt;phrase&gt;}<br />
    create the hyperlink, but with the attribute target="_blank" to open it in a new window
3.  {ln:&lt;phrase&gt; '&lt;title&gt;}<br />
    like 1., but use "title" as displayed text.
4.  {ln:nw:&lt;phrase&gt; '&lt;title&gt;}<br />
    like 3., but open the link in a new window
5.  {ln:search:&lt;phrase&gt;}<br />
    create a link which leads to the site-internal search results for &lt;phrase&gt;
6.  {ln:google:&lt;phrase&gt; '&lt;title&gt;}<br />
    create a link which leads to the google search for&lt;phrase&gt;
7.  {ln:http://www.eff.org 'Electronic Frontier Foundation}<br />
    creates and external link to the electronic frontier foundation
8.  {ln:op:&lt;phrase&gt;}&lt;img src="image.gif"/&gt;&lt;/a&gt;<br />
    create a hyperlinked image ("op" for "open", because it won't close "&lt;/a&gt;" tag)
9.  {ln:&lt;phrase&gt; '&lt;img src="image.jpg" /&gt; ''&lt;tooltip text&gt;}<br />
    create a hyperlinked image, linked to &lt;phrase&gt;, and with &lt;tooltip text&gt; as tooltip
10. {ln:css-mainlevel:&lt;phrase&gt;}<br />
    create simple hyperlink with "phrase" as displayed text and "mainlevel" as css class
11. {ln:search-icq:1234567}<br />
    http://wwp.icq.com/1234567 (show site for the ICQ number 1234567)
12. {ln:search-sourceforge:projects/dotplot/}<br />
    http://sourceforge.net/projects/dotplot/
13. {ln:limitstart-2:&lt;phrase&gt;}<br />
    like example 1., but goes to article page 2.

### Feedback and Support

Tobias Gesellchen (tobias@gesellix.de) is the main programmer.
Marc Perkel (marc@perkel.com) is the documentation guy.
We welcome your ideas and feedback on the program. Please use the [Tracker](https://github.com/gesellix/titlelink/issues) for feature suggestions or to submit bug reports.

### License

The TitleLink content plugin is released under the GPL License.

### Available site selectors for the search-&lt;site&gt; command

(from http://tavi.sourceforge.net/InterWiki)

<table>
  <tr><th>&lt;site&gt;</th><th>target link</th></tr>
  <tr><td>abbenormal</td><td>http://www.ourpla.net/cgi-bin/pikie.cgi?&lt;phrase&gt;</td></tr>
  <tr><td>acronym</td><td>http://www.acronymfinder.com/af-query.asp?String=exact&amp;Acronym=&lt;phrase&gt;</td></tr>
  <tr><td>advogato</td><td>http://www.advogato.org/&lt;phrase&gt;</td></tr>
  <tr><td>bible</td><td>http://bible.gospelcom.net/bible?&lt;phrase&gt;</td></tr>
  <tr><td>caffeinatedwiki</td><td>http://socrates.yi.org/&lt;phrase&gt;</td></tr>
  <tr><td>cliki</td><td>http://www.cliki.net/&lt;phrase&gt;</td></tr>
  <tr><td>cmwiki</td><td>http://www.cmwiki.com/&lt;phrase&gt;</td></tr>
  <tr><td>creationmatters</td><td>http://www.ourpla.net/cgi-bin/wiki.pl?&lt;phrase&gt;</td></tr>
  <tr><td>cssdiscusswiki</td><td>http://css-discuss.incutio.com/?page=&lt;phrase&gt;</td></tr>
  <tr><td>dictionary</td><td>http://www.dictionary.com/cgi-bin/dict.pl?term=&lt;phrase&gt;</td></tr>
  <tr><td>doiwalters</td><td>http://www.doiwalters.com/wiki/&lt;phrase&gt;</td></tr>
  <tr><td>emacswiki</td><td>http://www.emacswiki.org/cgi-bin/wiki/&lt;phrase&gt;</td></tr>
  <tr><td>everything2</td><td>http://www.everything2.com/&lt;phrase&gt;</td></tr>
  <tr><td>foldoc</td><td>http://www.foldoc.org/foldoc/foldoc.cgi?&lt;phrase&gt;</td></tr>
  <tr><td>foxwiki</td><td>http://fox.wikis.com/wc.dll?Wiki~&lt;phrase&gt;</td></tr>
  <tr><td>geekido</td><td>http://geekido.org/index.php?page=&lt;phrase&gt;</td></tr>
  <tr><td>google</td><td>http://www.google.com/search?q=&lt;phrase&gt;</td></tr>
  <tr><td>googlegroups</td><td>http://groups.google.com/groups?q=&lt;phrase&gt;</td></tr>
  <tr><td>h2g2</td><td>http://www.bbc.co.uk/h2g2/guide/Search?searchstring=&lt;phrase&gt;</td></tr>
  <tr><td>hootoo</td><td>http://www.bbc.co.uk/h2g2/guide/Search?searchstring=&lt;phrase&gt;</td></tr>
  <tr><td>hhgg</td><td>http://www.bbc.co.uk/dna/h2g2/&lt;phrase&gt;</td></tr>
  <tr><td>iawiki</td><td>http://www.IAwiki.net/&lt;phrase&gt;</td></tr>
  <tr><td>icq</td><td>http://wwp.icq.com/&lt;phrase&gt;</td></tr>
  <tr><td>imdb</td><td>http://us.imdb.com/Title?&lt;phrase&gt;</td></tr>
  <tr><td>jargonfile</td><td>http://sunir.org/apps/meta.pl?wiki=JargonFile&amp;redirect=&lt;phrase&gt;</td></tr>
  <tr><td>jtf</td><td>http://www.justthefaqs.org/?page=&lt;phrase&gt;</td></tr>
  <tr><td>knowhow</td><td>http://www2.iro.umontreal.ca/~paquetse/cgi-bin/wiki.cgi?&lt;phrase&gt;</td></tr>
  <tr><td>kwiki</td><td>http://kwiki.org/?&lt;phrase&gt;</td></tr>
  <tr><td>linuxquestions</td><td>http://wiki.linuxquestions.org/wiki/&lt;phrase&gt;</td></tr>
  <tr><td>livejournal</td><td>http://www.livejournal.com/users/&lt;phrase&gt;</td></tr>
  <tr><td>meatball</td><td>http://www.usemod.com/cgi-bin/mb.pl?&lt;phrase&gt;</td></tr>
  <tr><td>metawiki</td><td>http://sunir.org/apps/meta.pl?words=&lt;phrase&gt;</td></tr>
  <tr><td>moinmoin</td><td>http://moinmoin.wikiwikiweb.de/&lt;phrase&gt;</td></tr>
  <tr><td>openwiki</td><td>http://openwiki.com/ow.asp?&lt;phrase&gt;</td></tr>
  <tr><td>orgpatterns</td><td>http://www.bell-labs.com/cgi-user/OrgPatterns/OrgPatterns?&lt;phrase&gt;</td></tr>
  <tr><td>patent</td><td>http://patft.uspto.gov/netacgi/nph-Parser?patentnumber=&lt;phrase&gt;</td></tr>
  <tr><td>pgpkey</td><td>http://keys.pgp.dk:11371/pks/lookup?op=get&amp;search=&lt;phrase&gt;</td></tr>
  <tr><td>phpwiki</td><td>http://phpwiki.sourceforge.net/phpwiki/&lt;phrase&gt;</td></tr>
  <tr><td>pikie</td><td>http://pikie.webbing.nl/cgi-bin/pikie.cgi?&lt;phrase&gt;</td></tr>
  <tr><td>ppr</td><td>http://c2.com/cgi/wiki?&lt;phrase&gt;</td></tr>
  <tr><td>pythoninfo</td><td>http://www.python.org/cgi-bin/moinmoin/&lt;phrase&gt;</td></tr>
  <tr><td>rfc</td><td>http://www.rfc.org.uk/cgi-bin/lookup.cgi?rfc=&lt;phrase&gt;</td></tr>
  <tr><td>sourceforge</td><td>http://sourceforge.net/&lt;phrase&gt;</td></tr>
  <tr><td>squeak</td><td>http://minnow.cc.gatech.edu/squeak/&lt;phrase&gt;</td></tr>
  <tr><td>squirrelmail</td><td>http://squirrelmail.org/wiki/wiki.php?&lt;phrase&gt;</td></tr>
  <tr><td>tavi</td><td>http://tavi.sourceforge.net/&lt;phrase&gt;</td></tr>
  <tr><td>thesaurus</td><td>http://www.thesaurus.com/cgi-bin/search?config=roget&amp;words=&lt;phrase&gt;</td></tr>
  <tr><td>thinki</td><td>http://www.thinkware.se/cgi-bin/thinki.cgi/&lt;phrase&gt;</td></tr>
  <tr><td>twiki</td><td>http://twiki.sourceforge.net/cgi-bin/view/&lt;phrase&gt;</td></tr>
  <tr><td>usemod</td><td>http://www.usemod.com/cgi-bin/wiki.pl?&lt;phrase&gt;</td></tr>
  <tr><td>visualworks</td><td>http://wiki.cs.uiuc.edu/VisualWorks/&lt;phrase&gt;</td></tr>
  <tr><td>webster</td><td>http://m-w.com/cgi-bin/dictionary?va=&lt;phrase&gt;</td></tr>
  <tr><td>why</td><td>http://clublet.com/c/c/why?&lt;phrase&gt;</td></tr>
  <tr><td>wiki</td><td>http://c2.com/cgi/wiki?&lt;phrase&gt;</td></tr>
  <tr><td>wikifind</td><td>http://c2.com/cgi/wiki?FindPage&amp;value=&lt;phrase&gt;</td></tr>
  <tr><td>wikipedia</td><td>http://en.wikipedia.org/wiki/&lt;phrase&gt;</td></tr>
  <tr><td>wiktionary</td><td>http://en.wiktionary.org/wiki/&lt;phrase&gt;</td></tr>
  <tr><td>wunderground</td><td>http://www.wunderground.com/cgi-bin/findweather/getForecast?query=&lt;phrase&gt;</td></tr>
  <tr><td>zwiki</td><td>http://www.zwiki.org/&lt;phrase&gt;</td></tr>
</table>
