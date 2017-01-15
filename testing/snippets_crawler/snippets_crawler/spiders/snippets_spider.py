import scrapy


class SnippetsSpider(scrapy.Spider):
    name = "snippets"

    def start_requests(self):
        urls = [
            'http://localhost:8888/snippets.php',
        ]
        for url in urls:
            yield scrapy.Request(url=url, callback=self.parse)

    def parse(self, response):

        yield{
            "response url" : response.url,
            }
        forms = response.xpath('//form/@action').extract()
        for form in forms:
            yield{
                "form destination: " : form,
            }

        inputs = response.xpath('//input').extract()
        for inputtag in inputs:
            yield{
                "form input: " : inputtag,
            }
        textAreas = response.css("textarea").extract()
        for textArea in textAreas:
            yield{
                "textArea" : textArea,
            }
        for quote in response.css("li"):
            yield{
                "links": quote.css("a").extract(),
            }

        links = response.css('a::attr(href)').extract()
        for link in links:
                nexturl = response.urljoin(link)
                yield scrapy.Request(url=nexturl, callback=self.parse)
