# Mutated Genes, Pathways, Processes and protein Domains in tumours #

Combining many sources of information, we were able to create a dataset containing more than 5,000 genes mutated in cancers. A fisher's test has been applied to identify pathways (Kegg, Biocarta and Reactome), processes (Gene Ontology Biological Process) and protein domains (Interpro) that contain more mutated genes than expected by chance.

This web-service provides the resulting associations between the tumour types and cellular processes, pathways, and protein domains containing a significant number of mutated genes. Three threshold values (0.1, 0.01, 0.001) can be used to filter the fisher's test results.

The information is provided in [graphml](http://graphml.graphdrawing.org/) format. For each tumour type the list of mutated genes is also provided.

The raw data is also available to download in tab separate format:

Interactions:
http://ws.bioinfo.cnio.es/rest/diseases/interactions/interactions.txt

Annotations:
http://ws.bioinfo.cnio.es/rest/diseases/interactions/annotations.txt


# How to use the web service through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

## Examples ##

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=tumor-pathways&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/diseases/interactions/tab2graphml.php?threshold=0.1

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=tumor-pathways&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/diseases/interactions/tab2graphml.php?threshold=0.01

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=tumor-pathways&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/diseases/interactions/tab2graphml.php?threshold=0.001