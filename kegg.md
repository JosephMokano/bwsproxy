# KEGG #

  * http://www.kegg.jp/
  * http://www.genome.jp/kegg/soap/doc/keggapi_manual.html

# How to use KEGG API through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

These parameters can be submited by GET or POST.

## Examples ##

> ### bget ###
  * http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=bget&bwsp_response_format=raw&bwsp_url=http://soap.genome.jp?feature=pathway,id=hsa05212

> ### bconv ###
  * http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=bconv&bwsp_response_format=raw&bwsp_url=http://soap.genome.jp?database=uniprot,id=P04637

> ### get\_pathways\_by\_genes ###
  * http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=get_pathways_by_genes&bwsp_response_format=raw&bwsp_url=http://soap.genome.jp?genes=hsa:7157