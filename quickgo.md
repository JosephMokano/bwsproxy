# QuickGO #
http://www.ebi.ac.uk/QuickGO/WebServices.html

# How to use QuickGO through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

Aditional parameters specific for this service are:

  * **id** (GO term, required)
  * **format** (required)

These parameters can be submited by GET or POST.

## Examples ##

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=quickgo&bwsp_response_format=json&bwsp_url=http://www.ebi.ac.uk/QuickGO/GTerm?id=GO:0006357,format=oboxml