from collections import Mapping
from google.appengine.ext import blobstore


class BlobStore(Mapping):

    def __getitem__(self, name):
        blob_info = blobstore.BlobInfo.get(name)

        if not blob_info:
            raise KeyError(name)
        else:
            return blob_info

    def __setitem__(self, name, value):
        pass

    def __delitem__(self, name):
        self[name].delete()

    def __iter__(self):
        for b in blobstore.BlobInfo.all():
            yield str(b.key())

    def __len__(self):
        return blobstore.BlobInfo.all().count()

