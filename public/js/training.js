function testjs($uCoachId)
{
    var param = escape($uCoachId);
    location.href = "viewDataSet?uCoachId=" + param;
}
