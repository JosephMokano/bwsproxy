# Genome Statistics #

Retrieve several genome statistics using [http://www.biomart.org/](BioMart.md)

# How to use Sequence Synonyms through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

Aditional parameters specific for this service are:

  * **genome** (required)

These parameters can be submited by GET or POST.

## Examples ##

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=genomestatistics&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/genomestatistics/index.php?genome=esc_18_gene