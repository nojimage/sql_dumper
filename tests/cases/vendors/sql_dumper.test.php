<?php
App::import('Vendor', 'SqlDumper', array('plugin' => 'SqlDumper'));

class TestSqlDumper extends SqlDumper {


    function setupDatasouce($datasouce = 'default') {
        return parent::_setupDataSource($datasouce);
    }

    function getProcessTables($tablename = null, $exclude_missing_tables = false) {
        return parent::_getProcessTables($tablename, $exclude_missing_tables);
    }

    function checkCurrentDatasource($datasource) {
        return parent::_checkCurrentDatasource($datasource);
    }

    function setupOutput($datasource, $save) {
        return parent::_setupOutput($datasource, $save);
    }
}

class DumpTest extends CakeTestCase
{

    /**
     *
     * @var TestSqlDumper
     */
    public $TestObj;

    /**
     * startTest method
     *
     * @access public
     * @return void
     */
    function startTest()
    {
        $this->TestObj = new TestSqlDumper();
        $this->TestObj->setupDatasouce();
    }

    /**
     * endTest method
     *
     * @access public
     * @return void
     */
    function endTest()
    {
        unset($this->ClassRegistry);
        ClassRegistry::flush();
    }

    function testInit()
    {
        $sqlDumper = ClassRegistry::init('SqlDumper.SqlDumper', 'Vendor');
        $this->assertIsA($sqlDumper, 'SqlDumper');
    }

    function testSetupDatasource()
    {
        if (1) return;
        $this->TestObj->setupDatasouce();

        $this->assertTrue($this->TestObj->checkCurrentDatasource('default'));
    }

    function testSetupOutput()
    {
        if (1) return;
        $result = $this->TestObj->setupOutput('default', TMP);
        $this->assertTrue($result);
        debug($this->TestObj->File->path);
    }

    function testGetProcessTables()
    {
        if (1) return;

        $this->TestObj->setupDatasouce();

        $tables = $this->TestObj->getProcessTables();
        debug($tables);

        $tables = $this->TestObj->getProcessTables(null, true);
        debug($tables);

        $tables = $this->TestObj->getProcessTables('users', true);
        debug($tables);

        $tables = $this->TestObj->getProcessTables('hoge', true);
        debug($tables);
    }

    function testGetDropSql()
    {
        if (1) return;

        $sql = $this->TestObj->getDropSql('default', null);
        debug($sql);
    }

    function testGetCreateSql()
    {
        if (1) return;

        $sql = $this->TestObj->getCreateSql('default', null);
        debug($sql);
    }

    function testGetInsertSql()
    {
        if (1) return;
        $sql = $this->TestObj->getInsertSql('default', null, false, true);
        debug($sql);
    }

    function testProcess()
    {
        if (1) return;
        $sql = $this->TestObj->process('default');
        debug($sql);

    }

    function testProcessAll()
    {
        if (1) return;
        $this->TestObj->processAll(TMP);
    }


}