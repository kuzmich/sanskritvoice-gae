from google.appengine.ext import ndb, blobstore


class Bhajan(ndb.Model):
    title = ndb.StringProperty()
    text = ndb.TextProperty()
    accords = ndb.TextProperty()
    category=ndb.StringProperty()

    @property
    def id(self):
        return self.key.id()

    @property
    def records(self):
        return Record.query(Record.bhajan_key == self.key)

    @classmethod
    def _pre_delete_hook(cls, key):
        # TODO delete child perfomances
        pass

class Record(ndb.Model):
    artist = ndb.StringProperty()
    audio_key = ndb.BlobKeyProperty()
    bhajan_key = ndb.KeyProperty()

    @property
    def id(self):
        return self.key.id()

    @property
    def audio(self):
        return blobstore.BlobInfo.get(self.audio_key)

    @property
    def bhajan(self):
        return self.bhajan_key.get()

    @classmethod
    def _pre_delete_hook(cls, key):
        record = key.get()
        blobstore.delete(record.audio_key)
