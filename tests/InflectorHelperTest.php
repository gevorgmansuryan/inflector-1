<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Inflector\Tests;

use Yiisoft\Inflector\InflectorHelper;
use PHPUnit\Framework\TestCase;

/**
 * @group helpers
 */
class InflectorHelperTest extends TestCase
{
    public function testPluralize()
    {
        $testData = [
            'move' => 'moves',
            'foot' => 'feet',
            'child' => 'children',
            'human' => 'humans',
            'man' => 'men',
            'staff' => 'staff',
            'tooth' => 'teeth',
            'person' => 'people',
            'mouse' => 'mice',
            'touch' => 'touches',
            'hash' => 'hashes',
            'shelf' => 'shelves',
            'potato' => 'potatoes',
            'bus' => 'buses',
            'test' => 'tests',
            'car' => 'cars',
            'netherlands' => 'netherlands',
            'currency' => 'currencies',
        ];

        foreach ($testData as $testIn => $testOut) {
            $this->assertEquals($testOut, InflectorHelper::pluralize($testIn));
            $this->assertEquals(ucfirst($testOut), ucfirst(InflectorHelper::pluralize($testIn)));
        }
    }

    public function testSingularize()
    {
        $testData = [
            'moves' => 'move',
            'feet' => 'foot',
            'children' => 'child',
            'humans' => 'human',
            'men' => 'man',
            'staff' => 'staff',
            'teeth' => 'tooth',
            'people' => 'person',
            'mice' => 'mouse',
            'touches' => 'touch',
            'hashes' => 'hash',
            'shelves' => 'shelf',
            'potatoes' => 'potato',
            'buses' => 'bus',
            'tests' => 'test',
            'cars' => 'car',
            'Netherlands' => 'Netherlands',
            'currencies' => 'currency',
        ];
        foreach ($testData as $testIn => $testOut) {
            $this->assertEquals($testOut, InflectorHelper::singularize($testIn));
            $this->assertEquals(ucfirst($testOut), ucfirst(InflectorHelper::singularize($testIn)));
        }
    }

    public function testTitleize()
    {
        $this->assertEquals('Me my self and i', InflectorHelper::titleize('MeMySelfAndI'));
        $this->assertEquals('Me My Self And I', InflectorHelper::titleize('MeMySelfAndI', true));
        $this->assertEquals('Треба Більше Тестів!', InflectorHelper::titleize('ТребаБільшеТестів!', true));
    }

    public function testCamelize()
    {
        $this->assertEquals('MeMySelfAndI', InflectorHelper::camelize('me my_self-andI'));
        $this->assertEquals('QweQweEwq', InflectorHelper::camelize('qwe qwe^ewq'));
        $this->assertEquals('ВідомоЩоТестиЗберігатьНашіНЕРВИ', InflectorHelper::camelize('Відомо, що тести зберігать наші НЕРВИ! 🙃'));
    }

    public function testUnderscore()
    {
        $this->assertEquals('me_my_self_and_i', InflectorHelper::underscore('MeMySelfAndI'));
        $this->assertEquals('кожний_тест_особливий', InflectorHelper::underscore('КожнийТестОсобливий'));
    }

    public function testCamel2words()
    {
        $this->assertEquals('Camel Case', InflectorHelper::camel2words('camelCase'));
        $this->assertEquals('Lower Case', InflectorHelper::camel2words('lower_case'));
        $this->assertEquals('Tricky Stuff It Is Testing', InflectorHelper::camel2words(' tricky_stuff.it-is testing... '));
        $this->assertEquals('І Це Дійсно Так!', InflectorHelper::camel2words('ІЦеДійсноТак!'));
    }

    public function testCamel2id()
    {
        $this->assertEquals('post-tag', InflectorHelper::camel2id('PostTag'));
        $this->assertEquals('post_tag', InflectorHelper::camel2id('PostTag', '_'));
        $this->assertEquals('єдиний_код', InflectorHelper::camel2id('ЄдинийКод', '_'));

        $this->assertEquals('post-tag', InflectorHelper::camel2id('postTag'));
        $this->assertEquals('post_tag', InflectorHelper::camel2id('postTag', '_'));
        $this->assertEquals('єдиний_код', InflectorHelper::camel2id('єдинийКод', '_'));

        $this->assertEquals('foo-ybar', InflectorHelper::camel2id('FooYBar', '-', false));
        $this->assertEquals('foo_ybar', InflectorHelper::camel2id('fooYBar', '_', false));
        $this->assertEquals('невже_іце_працює', InflectorHelper::camel2id('НевжеІЦеПрацює', '_', false));

        $this->assertEquals('foo-y-bar', InflectorHelper::camel2id('FooYBar', '-', true));
        $this->assertEquals('foo_y_bar', InflectorHelper::camel2id('fooYBar', '_', true));
        $this->assertEquals('foo_y_bar', InflectorHelper::camel2id('fooYBar', '_', true));
        $this->assertEquals('невже_і_це_працює', InflectorHelper::camel2id('НевжеІЦеПрацює', '_', true));
    }

    public function testId2camel()
    {
        $this->assertEquals('PostTag', InflectorHelper::id2camel('post-tag'));
        $this->assertEquals('PostTag', InflectorHelper::id2camel('post_tag', '_'));
        $this->assertEquals('ЄдинийСвіт', InflectorHelper::id2camel('єдиний_світ', '_'));

        $this->assertEquals('PostTag', InflectorHelper::id2camel('post-tag'));
        $this->assertEquals('PostTag', InflectorHelper::id2camel('post_tag', '_'));
        $this->assertEquals('НевжеІЦеПрацює', InflectorHelper::id2camel('невже_і_це_працює', '_'));

        $this->assertEquals('ShouldNotBecomeLowercased', InflectorHelper::id2camel('ShouldNotBecomeLowercased', '_'));

        $this->assertEquals('FooYBar', InflectorHelper::id2camel('foo-y-bar'));
        $this->assertEquals('FooYBar', InflectorHelper::id2camel('foo_y_bar', '_'));
    }

    public function testHumanize()
    {
        $this->assertEquals('Me my self and i', InflectorHelper::humanize('me_my_self_and_i'));
        $this->assertEquals('Me My Self And I', InflectorHelper::humanize('me_my_self_and_i', true));
        $this->assertEquals('Але й веселі ці ваші тести', InflectorHelper::humanize('але_й_веселі_ці_ваші_тести'));
    }

    public function testVariablize()
    {
        $this->assertEquals('customerTable', InflectorHelper::variablize('customer_table'));
        $this->assertEquals('ひらがなHepimiz', InflectorHelper::variablize('ひらがな_hepimiz'));
    }

    public function testTableize()
    {
        $this->assertEquals('customer_tables', InflectorHelper::tableize('customerTable'));
    }

    public function testSlugCommons()
    {
        $data = [
            '' => '',
            'hello world 123' => 'hello-world-123',
            'remove.!?[]{}…symbols' => 'removesymbols',
            'minus-sign' => 'minus-sign',
            'mdash—sign' => 'mdash-sign',
            'ndash–sign' => 'ndash-sign',
            'áàâéèêíìîóòôúùûã' => 'aaaeeeiiiooouuua',
            'älä lyö ääliö ööliä läikkyy' => 'ala-lyo-aalio-oolia-laikkyy',
        ];

        foreach ($data as $source => $expected) {
            if (extension_loaded('intl')) {
                $this->assertEquals($expected, FallbackInflector::slug($source));
            }
            $this->assertEquals($expected, InflectorHelper::slug($source));
        }
    }
    
    public function testSlugReplacements()
    {
        $this->assertEquals('dont_replace_replacement', InflectorHelper::slug('dont replace_replacement', '_'));
        $this->assertEquals('remove_trailing_replacements', InflectorHelper::slug('_remove trailing replacements_', '_'));
        $this->assertEquals('thisrepisreprepreplacement', InflectorHelper::slug('this is REP-lacement', 'REP'));
        $this->assertEquals('0_100_kmh', InflectorHelper::slug('0-100 Km/h', '_'));
    }

    public function testSlugIntl()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped('intl extension is required.');
        }

        // Some test strings are from https://github.com/bergie/midgardmvc_helper_urlize. Thank you, Henri Bergius!
        $data = [
            // Korean
            '해동검도' => 'haedong-geomdo',
            // Hiragana
            'ひらがな' => 'hiragana',
            // Georgian
            'საქართველო' => 'sakartvelo',
            // Arabic
            'العربي' => 'alrby',
            'عرب' => 'rb',
            // Hebrew
            'עִבְרִית' => 'iberiyt',
            // Turkish
            'Sanırım hepimiz aynı şeyi düşünüyoruz.' => 'sanirim-hepimiz-ayni-seyi-dusunuyoruz',
            // Russian
            'недвижимость' => 'nedvizimost',
            'Контакты' => 'kontakty',
            // Chinese
            '美国' => 'mei-guo',
            // Estonian
            'Jääär' => 'jaaar',
        ];

        foreach ($data as $source => $expected) {
            $this->assertEquals($expected, InflectorHelper::slug($source));
        }
    }

    public function testTransliterateStrict()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped('intl extension is required.');
        }

        // Some test strings are from https://github.com/bergie/midgardmvc_helper_urlize. Thank you, Henri Bergius!
        $data = [
            // Korean
            '해동검도' => 'haedong-geomdo',
            // Hiragana
            'ひらがな' => 'hiragana',
            // Georgian
            'საქართველო' => 'sakartvelo',
            // Arabic
            'العربي' => 'ạlʿrby',
            'عرب' => 'ʿrb',
            // Hebrew
            'עִבְרִית' => 'ʻibĕriyţ',
            // Turkish
            'Sanırım hepimiz aynı şeyi düşünüyoruz.' => 'Sanırım hepimiz aynı şeyi düşünüyoruz.',

            // Russian
            'недвижимость' => 'nedvižimostʹ',
            'Контакты' => 'Kontakty',

            // Ukrainian
            'Українська: ґанок, європа' => 'Ukraí̈nsʹka: g̀anok, êvropa',

            // Serbian
            'Српска: ђ, њ, џ!' => 'Srpska: đ, n̂, d̂!',

            // Spanish
            '¿Español?' => '¿Español?',
            // Chinese
            '美国' => 'měi guó',
        ];

        foreach ($data as $source => $expected) {
            $this->assertEquals($expected, InflectorHelper::transliterate($source, InflectorHelper::TRANSLITERATE_STRICT));
        }
    }

    public function testTransliterateMedium()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped('intl extension is required.');
        }

        // Some test strings are from https://github.com/bergie/midgardmvc_helper_urlize. Thank you, Henri Bergius!
        $data = [
            // Korean
            '해동검도' => ['haedong-geomdo'],
            // Hiragana
            'ひらがな' => ['hiragana'],
            // Georgian
            'საქართველო' => ['sakartvelo'],
            // Arabic
            'العربي' => ['alʿrby'],
            'عرب' => ['ʿrb'],
            // Hebrew
            'עִבְרִית' => ['\'iberiyt', 'ʻiberiyt'],
            // Turkish
            'Sanırım hepimiz aynı şeyi düşünüyoruz.' => ['Sanirim hepimiz ayni seyi dusunuyoruz.'],

            // Russian
            'недвижимость' => ['nedvizimost\'', 'nedvizimostʹ'],
            'Контакты' => ['Kontakty'],

            // Ukrainian
            'Українська: ґанок, європа' => ['Ukrainsʹka: ganok, evropa', 'Ukrains\'ka: ganok, evropa'],

            // Serbian
            'Српска: ђ, њ, џ!' => ['Srpska: d, n, d!'],

            // Spanish
            '¿Español?' => ['¿Espanol?'],
            // Chinese
            '美国' => ['mei guo'],
        ];

        foreach ($data as $source => $allowed) {
            $this->assertIsOneOf(InflectorHelper::transliterate($source, InflectorHelper::TRANSLITERATE_MEDIUM), $allowed);
        }
    }

    public function testTransliterateLoose()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped('intl extension is required.');
        }

        // Some test strings are from https://github.com/bergie/midgardmvc_helper_urlize. Thank you, Henri Bergius!
        $data = [
            // Korean
            '해동검도' => ['haedong-geomdo'],
            // Hiragana
            'ひらがな' => ['hiragana'],
            // Georgian
            'საქართველო' => ['sakartvelo'],
            // Arabic
            'العربي' => ['alrby'],
            'عرب' => ['rb'],
            // Hebrew
            'עִבְרִית' => ['\'iberiyt', 'iberiyt'],
            // Turkish
            'Sanırım hepimiz aynı şeyi düşünüyoruz.' => ['Sanirim hepimiz ayni seyi dusunuyoruz.'],

            // Russian
            'недвижимость' => ['nedvizimost\'', 'nedvizimost'],
            'Контакты' => ['Kontakty'],

            // Ukrainian
            'Українська: ґанок, європа' => ['Ukrainska: ganok, evropa', 'Ukrains\'ka: ganok, evropa'],

            // Serbian
            'Српска: ђ, њ, џ!' => ['Srpska: d, n, d!'],

            // Spanish
            '¿Español?' => ['Espanol?'],
            // Chinese
            '美国' => ['mei guo'],
        ];

        foreach ($data as $source => $allowed) {
            $this->assertIsOneOf(InflectorHelper::transliterate($source, InflectorHelper::TRANSLITERATE_LOOSE), $allowed);
        }
    }

    public function testSlugPhp()
    {
        $data = [
            'we have недвижимость' => 'we-have',
        ];

        foreach ($data as $source => $expected) {
            $this->assertEquals($expected, FallbackInflector::slug($source));
        }
    }

    public function testClassify()
    {
        $this->assertEquals('CustomerTable', InflectorHelper::classify('customer_tables'));
    }

    public function testOrdinalize()
    {
        $this->assertEquals('21st', InflectorHelper::ordinalize('21'));
        $this->assertEquals('22nd', InflectorHelper::ordinalize('22'));
        $this->assertEquals('23rd', InflectorHelper::ordinalize('23'));
        $this->assertEquals('24th', InflectorHelper::ordinalize('24'));
        $this->assertEquals('25th', InflectorHelper::ordinalize('25'));
        $this->assertEquals('111th', InflectorHelper::ordinalize('111'));
        $this->assertEquals('113th', InflectorHelper::ordinalize('113'));
    }

    public function testSentence()
    {
        $array = [];
        $this->assertEquals('', InflectorHelper::sentence($array));

        $array = ['Spain'];
        $this->assertEquals('Spain', InflectorHelper::sentence($array));

        $array = ['Spain', 'France'];
        $this->assertEquals('Spain and France', InflectorHelper::sentence($array));

        $array = ['Spain', 'France', 'Italy'];
        $this->assertEquals('Spain, France and Italy', InflectorHelper::sentence($array));

        $array = ['Spain', 'France', 'Italy', 'Germany'];
        $this->assertEquals('Spain, France, Italy and Germany', InflectorHelper::sentence($array));

        $array = ['Spain', 'France'];
        $this->assertEquals('Spain or France', InflectorHelper::sentence($array, ' or '));

        $array = ['Spain', 'France', 'Italy'];
        $this->assertEquals('Spain, France or Italy', InflectorHelper::sentence($array, ' or '));

        $array = ['Spain', 'France'];
        $this->assertEquals('Spain and France', InflectorHelper::sentence($array, ' and ', ' or ', ' - '));

        $array = ['Spain', 'France', 'Italy'];
        $this->assertEquals('Spain - France or Italy', InflectorHelper::sentence($array, ' and ', ' or ', ' - '));
    }

    /** Asserts that value is one of expected values.
     *
     * @param mixed $actual
     * @param array $expected
     * @param string $message
     */
    private function assertIsOneOf($actual, array $expected, $message = '')
    {
        self::assertThat($actual, new IsOneOfAssert($expected), $message);
    }

}
