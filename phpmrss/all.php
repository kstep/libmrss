<?
//dl("mrss.so");

function check ($a) {
  if(mrss_error($a)!=MRSS_OK)
  {
    echo "*** ".mrss_strerror($a)." ***\n";
    exit;
  }
}
//$data=mrss_parse_url("http://ngvision.org/rss");
$data=mrss_parse_url("http://feeds.feedburner.com/9to5Chic");
check($data);
print_r (mrss_get($data));
?>
