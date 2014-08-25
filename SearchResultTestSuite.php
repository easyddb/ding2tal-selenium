<?php

require_once(dirname(__FILE__) . '/config.inc');

class SearchResult extends PHPUnit_Extensions_SeleniumTestCase {

  protected function setUp() {
    $this->setBrowser(TARGET_BROWSER);
    $this->setBrowserUrl(TARGET_URL);
  }

  public function testSearchBoxAnonymous() {
    $this->open("/en");
    $this->type("id=edit-search-block-form--2", "Dune");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Dúné"));
    $this->assertTrue($this->isElementPresent("link=Gregers Tycho"));
    $this->click("link=Gregers Tycho");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Dúné"));
    $this->assertTrue($this->isElementPresent("link=Gregers Tycho"));
    $this->type("id=edit-search-block-form--2", "star wars");
    $this->click("id=edit-submit--3");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Star Wars : The Essential Guide to the Force"));
    $this->assertTrue($this->isElementPresent("link=Star Wars (Random House Paperback)"));
    $this->click("link=Star Wars (Random House Paperback)");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Star Wars : The Essential Guide to the Force"));
    $this->assertTrue($this->isElementPresent("link=Star Wars (Random House Paperback)"));
  }

  public function testSearchBoxLoggedIn() {
    $this->open("/en");
    $this->click("//div[@id='page']/header/section/div/ul/li[3]/a/span");
    $this->type("id=edit-name", TARGET_URL_USER);
    $this->type("id=edit-pass", TARGET_URL_USER_PASS);
    $this->click("id=edit-submit--2");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "Dune");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Dúné"));
    $this->assertTrue($this->isElementPresent("link=Gregers Tycho"));
    $this->click("link=Gregers Tycho");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Dúné"));
    $this->assertTrue($this->isElementPresent("link=Gregers Tycho"));
    $this->type("id=edit-search-block-form--2", "star wars");
    $this->click("id=edit-submit--3");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Star Wars : The Essential Guide to the Force"));
    $this->assertTrue($this->isElementPresent("link=Star Wars (Random House Paperback)"));
    $this->click("link=Star Wars (Random House Paperback)");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Star Wars : The Essential Guide to the Force"));
    $this->assertTrue($this->isElementPresent("link=Star Wars (Random House Paperback)"));
  }

  public function testSortingAnonymous() {
    $this->open("/en");
    $this->type("id=edit-search-block-form--2", "45154211 OR 43615513 OR 000305954");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Inferno"));
    $this->assertEquals("", $this->getSelectedValue("id=edit-sort"));
    $this->assertEquals("Sort by: RankingSort by: Title (Ascending)Sort by: Title (Descending)Sort by: Creator (Ascending)Sort by: Creator (Descending)Sort by: Date (Ascending)Sort by: Date (Descending)", $this->getText("id=edit-sort"));
    $this->select("id=edit-sort", "label=Sort by: Title (Ascending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Title (Descending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Creator (Ascending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Creator (Descending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Date (Ascending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Date (Descending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
  }

  public function testSortingLoggedIn() {
    $this->open("/en");
    $this->click("link=Login");
    $this->type("id=edit-name", TARGET_URL_USER);
    $this->type("id=edit-pass", TARGET_URL_USER_PASS);
    $this->click("id=edit-submit--2");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("My Account", $this->getText("//div[@id='page']/header/section/div/ul/li[3]/a/span"));
    $this->open("/en");
    $this->type("id=edit-search-block-form--2", "45154211 OR 43615513 OR 000305954");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Inferno"));
    $this->assertEquals("", $this->getSelectedValue("id=edit-sort"));
    $this->assertEquals("Sort by: RankingSort by: Title (Ascending)Sort by: Title (Descending)Sort by: Creator (Ascending)Sort by: Creator (Descending)Sort by: Date (Ascending)Sort by: Date (Descending)", $this->getText("id=edit-sort"));
    $this->select("id=edit-sort", "label=Sort by: Title (Ascending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Title (Descending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Creator (Ascending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Creator (Descending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Date (Ascending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->select("id=edit-sort", "label=Sort by: Date (Descending)");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Trchnicolour", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Inferno", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[2]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Zos kia cultus", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[3]/div/div/div[2]/div/h2/a"));
    $this->assertEquals("Sprache als Herrschaft : semiotische Kritik des \"Guten Menschen von Sezuan\", der Theorie Brechts und der literarischen Wertung", $this->getText("//div[@id='page']/div/div/div/div/div/div/div/div[7]/div/div/ul/li[4]/div/div/div[2]/div/h2/a"));
    $this->click("//div[@id='page']/header/section/div/ul/li[5]/a/span");
    $this->waitForPageToLoad("30000");
  }

  public function testAvailabilityMarkers() {
    $this->open("/en");
    $this->click("//div[@id='page']/header/section/div/ul/li[3]/a/span");
    $this->type("id=edit-name", TARGET_URL_USER);
    $this->type("id=edit-pass", TARGET_URL_USER_PASS);
    $this->click("id=edit-submit--2");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "Dune");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Dúné"));
    $this->assertTrue($this->isElementPresent("css=p.js-pending"));
    $this->assertTrue($this->isElementPresent("id=availability-870970-basis28017499-bog"));
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("xpath=(//a[contains(text(),'Dune')])[2]"));
    $this->assertTrue($this->isElementPresent("css=p.js-online"));
    $this->assertTrue($this->isElementPresent("link=Lydbog (net)"));
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Klit"));
    $this->assertTrue($this->isElementPresent("css=p.js-pending"));
    $this->assertTrue($this->isElementPresent("id=availability-870970-basis28443471-bog"));
    $this->click("//div[@id='page']/header/section/div/ul/li[5]/a/span");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "Dune");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Dúné"));
    $this->assertTrue($this->isElementPresent("css=p.js-pending"));
    $this->assertTrue($this->isElementPresent("id=availability-870970-basis28017499-bog"));
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("xpath=(//a[contains(text(),'Dune')])[2]"));
    $this->assertTrue($this->isElementPresent("css=p.js-online"));
    $this->assertTrue($this->isElementPresent("link=Lydbog (net)"));
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Klit"));
    $this->assertTrue($this->isElementPresent("css=p.js-pending"));
    $this->assertTrue($this->isElementPresent("id=availability-870970-basis28443471-bog"));
  }

  public function testPagination() {
    $this->open("/en");
    $this->type("id=edit-name", TARGET_URL_USER);
    $this->type("id=edit-pass", TARGET_URL_USER_PASS);
    $this->click("id=edit-submit--2");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "jazz");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("1", $this->getText("css=li.pager-current"));
    $this->assertTrue($this->isElementPresent("link=next ›"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=1$/', $this->getAttribute("link=2@href")));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=1$/', $this->getAttribute("link=next ›@href")));
    $this->click("link=2");
    $this->waitForPageToLoad("30000");
    $this->click("link=1");
    $this->assertEquals("/en/search/ting/jazz", $this->getAttribute("link=‹ previous@href"));
    $this->assertEquals("/en/search/ting/jazz", $this->getAttribute("link=1@href"));
    $this->assertEquals("2", $this->getText("css=li.pager-current"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=2$/', $this->getAttribute("link=3@href")));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=2$/', $this->getAttribute("link=next ›@href")));
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("/en/search/ting/jazz", $this->getAttribute("link=« first@href"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=1$/', $this->getAttribute("link=‹ previous@href")));
    $this->assertEquals("/en/search/ting/jazz", $this->getAttribute("link=1@href"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=1$/', $this->getAttribute("link=2@href")));
    $this->assertEquals("3", $this->getText("css=li.pager-current"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=3$/', $this->getAttribute("link=4@href")));
    $this->click("link=next ›");
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=3$/', $this->getAttribute("link=next ›@href")));
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=4$/', $this->getAttribute("link=5@href")));
    $this->click("//div[@id='page']/header/section/div/ul/li[5]/a/span");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "jazz");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("1", $this->getText("css=li.pager-current"));
    $this->assertTrue($this->isElementPresent("link=next ›"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=1$/', $this->getAttribute("link=2@href")));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=1$/', $this->getAttribute("link=next ›@href")));
    $this->click("link=2");
    $this->waitForPageToLoad("30000");
    $this->click("link=1");
    $this->assertEquals("/en/search/ting/jazz", $this->getAttribute("link=‹ previous@href"));
    $this->assertEquals("/en/search/ting/jazz", $this->getAttribute("link=1@href"));
    $this->assertEquals("2", $this->getText("css=li.pager-current"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=2$/', $this->getAttribute("link=3@href")));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=2$/', $this->getAttribute("link=next ›@href")));
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("/en/search/ting/jazz", $this->getAttribute("link=« first@href"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=1$/', $this->getAttribute("link=‹ previous@href")));
    $this->assertEquals("/en/search/ting/jazz", $this->getAttribute("link=1@href"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=1$/', $this->getAttribute("link=2@href")));
    $this->assertEquals("3", $this->getText("css=li.pager-current"));
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=3$/', $this->getAttribute("link=4@href")));
    $this->click("link=next ›");
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=3$/', $this->getAttribute("link=next ›@href")));
    $this->click("link=next ›");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool) preg_match('/\/search\/ting\/jazz[\s\S]page=4$/', $this->getAttribute("link=5@href")));
  }

  public function testMaterialCollection() {
    $this->open("/en");
    $this->click("//div[@id='page']/header/section/div/ul/li[3]/a/span");
    $this->type("id=edit-name", TARGET_URL_USER);
    $this->type("id=edit-pass", TARGET_URL_USER_PASS);
    $this->click("id=edit-submit--2");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "Dune Frank Herbert");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Samhørende: Dune, Dune messiah, Children of Dune; God emperor of Dune, Heretics of Dune, Chapterhouse", $this->getText("css=div.field-item.even"));
    $this->click("link=Dune messiah");
    $this->waitForPageToLoad("30000");
    try {
      $this->assertEquals("\"Dune messiah\"", $this->getValue("id=edit-search-block-form--2"));
    }
    catch (PHPUnit_Framework_AssertionFailedError $e) {
      array_push($this->verificationErrors, $e->toString());
    }
    $this->click("//div[@id='page']/header/section/div/ul/li[5]/a/span");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "Dune Frank Herbert");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Samhørende: Dune, Dune messiah, Children of Dune; God emperor of Dune, Heretics of Dune, Chapterhouse", $this->getText("css=div.field-item.even"));
    $this->click("link=Dune messiah");
    $this->waitForPageToLoad("30000");
    try {
      $this->assertEquals("\"Dune messiah\"", $this->getValue("id=edit-search-block-form--2"));
    }
    catch (PHPUnit_Framework_AssertionFailedError $e) {
      array_push($this->verificationErrors, $e->toString());
    }
  }

  public function testSeriesAnonymous() {
    $this->open("/en");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "islandica eggert olafsson");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Eggert Ólafsson"));
    $this->assertTrue($this->isElementPresent("link=Islandica"));
    $this->click("link=Islandica");
    $this->waitForPageToLoad("30000");
    try {
      $this->assertEquals("phrase.titleSeries=\"islandica\"", $this->getValue("id=edit-search-block-form--2"));
    }
    catch (PHPUnit_Framework_AssertionFailedError $e) {
      array_push($this->verificationErrors, $e->toString());
    }
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Eggert Olafsson : A biographical sketch"));
    $this->assertTrue($this->isElementPresent("link=Islandica"));
  }

  public function testSeriesLoggedIn() {
    $this->open("/en");
    $this->click("//div[@id='page']/header/section/div/ul/li[3]/a/span");
    $this->type("id=edit-name", TARGET_URL_USER);
    $this->type("id=edit-pass", TARGET_URL_USER_PASS);
    $this->click("id=edit-submit--2");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "islandica eggert olafsson");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Eggert Ólafsson"));
    $this->assertTrue($this->isElementPresent("link=Islandica"));
    $this->click("link=Islandica");
    $this->waitForPageToLoad("30000");
    try {
      $this->assertEquals("phrase.titleSeries=\"islandica\"", $this->getValue("id=edit-search-block-form--2"));
    }
    catch (PHPUnit_Framework_AssertionFailedError $e) {
      array_push($this->verificationErrors, $e->toString());
    }
    $this->assertTrue($this->isElementPresent("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("link=Eggert Olafsson : A biographical sketch"));
    $this->assertTrue($this->isElementPresent("link=Islandica"));
    $this->click("//div[@id='page']/header/section/div/ul/li[5]/a/span");
  }

  public function testCoversAnonymous() {
    $this->open("/en");
    $this->open("search/ting/harry potter?page=2");
    sleep(10);
    $this->assertFalse($this->isElementPresent("css=.search-results .search-result:nth-child(1) img"));
    $this->assertTrue($this->isElementPresent("css=.search-results .search-result:nth-child(5) img"));
  }

  public function testCoversLoggedIn() {
    $this->open("/en");
    $this->click("//div[@id='page']/header/section/div/ul/li[3]/a/span");
    $this->type("id=edit-name", TARGET_URL_USER);
    $this->type("id=edit-pass", TARGET_URL_USER_PASS);
    $this->click("id=edit-submit--2");
    $this->waitForPageToLoad("30000");
    $this->open("/search/ting/harry potter?page=2");
    $this->assertFalse($this->isElementPresent("css=.search-results .search-result:nth-child(1) img"));
    $this->assertTrue($this->isElementPresent("css=.search-results .search-result:nth-child(5) img"));
    $this->click("//div[@id='page']/header/section/div/ul/li[5]/a/span");
    $this->waitForPageToLoad("30000");
  }

  public function testRecordViewAnonymous() {
    $this->open("/en");
    $this->type("id=edit-search-block-form--2", "klit");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("", $this->getText("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("css=span.search-result--heading-type"));
    $this->assertTrue($this->isElementPresent("link=Samfundet vasker sine hænder med metadon"));
    $this->assertTrue($this->isElementPresent("link=Klit"));
    $this->click("link=Samfundet vasker sine hænder med metadon");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("css=h2.pane-title"));
    $this->assertTrue($this->isElementPresent("//div[@id='page']/div/div/div/div/div/div/aside/div[2]/h2"));
    $this->assertTrue($this->isElementPresent("link=Samfundet vasker sine hænder med metadon"));
    $this->assertTrue($this->isElementPresent("id=availability-870971-avis71179532"));
    $this->assertTrue($this->isElementPresent("link=Klit"));
    $this->assertTrue($this->isElementPresent("link=Material details"));
    $this->assertTrue($this->isElementPresent("id=bookmark-870971-avis:71179532"));
  }

  public function testRecordViewLoggedIn() {
    $this->open("/en");
    $this->click("//div[@id='page']/header/section/div/ul/li[3]/a/span");
    $this->type("id=edit-name", TARGET_URL_USER);
    $this->type("id=edit-pass", TARGET_URL_USER_PASS);
    $this->click("id=edit-submit--2");
    $this->waitForPageToLoad("30000");
    $this->type("id=edit-search-block-form--2", "klit");
    $this->click("id=edit-submit");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("", $this->getText("id=edit-search-block-form--2"));
    $this->assertTrue($this->isElementPresent("css=span.search-result--heading-type"));
    $this->assertTrue($this->isElementPresent("link=Samfundet vasker sine hænder med metadon"));
    $this->assertTrue($this->isElementPresent("link=Klit"));
    $this->click("link=Samfundet vasker sine hænder med metadon");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("css=h2.pane-title"));
    $this->assertTrue($this->isElementPresent("//div[@id='page']/div/div/div/div/div/div/aside/div[2]/h2"));
    $this->assertTrue($this->isElementPresent("link=Samfundet vasker sine hænder med metadon"));
    $this->assertTrue($this->isElementPresent("id=availability-870971-avis71179532"));
    $this->assertTrue($this->isElementPresent("link=Klit"));
    $this->assertTrue($this->isElementPresent("link=Material details"));
    $this->assertTrue($this->isElementPresent("id=bookmark-870971-avis:71179532"));
  }
}
