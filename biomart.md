# Biomart #

For more information please visit the Biomart web site:

  * [http://www.biomart.org/](http://www.biomart.org/)

# How to use Biomart web services through the Biological Web Services Proxy #

See the [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters)


## Examples ##

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=biomart&bwsp_response_format=raw-capsule&bwsp_url=http://www.biomart.org/biomart/martservice?query=<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE Query>

&lt;Query  virtualSchemaName = "default" formatter = "TSV" header = "0" uniqueRows = "0" count = "" datasetConfigVersion = "0.7" &gt;



&lt;Dataset name = "hsapiens\_gene\_ensembl" interface = "default" &gt;



&lt;Filter name = "ensembl\_gene\_id" value = "ENSG00000206672"/&gt;



&lt;Attribute name = "ensembl\_gene\_id" /&gt;



&lt;Attribute name = "ensembl\_transcript\_id" /&gt;



&lt;/Dataset&gt;



&lt;/Query&gt;

