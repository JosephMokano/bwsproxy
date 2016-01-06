The goal of this web service is to provide REST access to the bionemo database

http://bionemo.bioinfo.cnio.es

# How to use Bionemo through the Biological Web Services Proxy #

See the [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters)

# Examples #

## Genes ##

**Get all genes**

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=bionemo&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/bionemo/index.php?cmd=getAllGenes

**Get gene by Iname**

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=bionemo&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/bionemo/index.php?cmd=getGeneByName,id=etbA1

## Operons ##

**Get all operons**

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=bionemo&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/bionemo/index.php?cmd=getAllOperons

**Get operon by name**

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=bionemo&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/bionemo/index.php?cmd=getOperonByName,id=catABC