<?php

include_once(__DIR__.'/CommandExecutingTest.php');

class CommandsTest extends CommandExecutingTest
{
    static $backupArgv;

    public function testIndexation()
    {
        $sql = "SELECT object_count FROM ezsearch_word WHERE word = 'ceci'";
        $conn = $this->getContainer()->get('ezpublish.connection')->getConnection();
        $stmt = $conn->executeQuery($sql);
        $result = $stmt->fetch();
        $before = (int)$result['object_count'];

        $this->runMigration('Tests/dsl/good/IndexationTest001.yml');

        $sql = "SELECT object_count FROM ezsearch_word WHERE word = 'ceci'";
        $conn = $this->getContainer()->get('ezpublish.connection')->getConnection();
        $stmt = $conn->executeQuery($sql);
        $result = $stmt->fetch();
        $this->assertEquals(2, (int)$result['object_count'] - $before);

        $this->runMigration('Tests/dsl/good/IndexationTest001_post.yml');
    }

    protected function runMigration($path, array $params = array())
    {
        /// @todo should we first remove the migration if it was already run?
        $params = array_merge($params, array('--path' => array($path), '-n' => true, '-u' => true));
        $out = $this->runCommand('kaliop:migration:migrate', $params);
        // check that there are no notes related to adding the migration before execution
        //$this->assertNotContains('Skipping ' . basename($path), $out, "Migration definition is incorrect?");
        $this->assertRegexp('?\| ' . basename($path) . ' +\| +\|?', $out);
        return $out;
    }
}
